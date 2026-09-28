<?php

namespace App\Providers;

use League\Flysystem\Filesystem;
use League\Flysystem\Sftp\SftpAdapter;
use Illuminate\Support\Facades\View;
use App\Models\Settings;
use App\Models\SettingsCont;
use App\Models\TermsPrivacy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (
            config('app.env') === 'production' 
            || env('FORCE_HTTPS', false) 
            || (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
            || (isset($_SERVER['SERVER_PORT']) && (int)$_SERVER['SERVER_PORT'] === 443)
            || (!app()->runningInConsole() && !in_array(request()->getHost(), ['localhost', '127.0.0.1', 'eglines.test']))
        ) {
            URL::forceScheme('https');
        }

        FacadesStorage::extend('sftp', function ($app, $config) {
            return new Filesystem(new SftpAdapter($config));
        });

        Paginator::useBootstrap();

        try {
            \App\Helpers\MetaBannerHelper::ensureMetaBannerExists();
        } catch (\Throwable $e) {
            // Silently continue if filesystem write is restricted
        }

        // Sharing settings with all view
        $settings = Settings::where('id', '1')->first();
        if ($settings) {
            $dirty = false;
            if (empty($settings->description) || str_contains(strtolower($settings->description), 'largest cryptocurrency exchange') || str_contains(strtolower($settings->description), 'online trader')) {
                $settings->description = 'Enterprise-grade digital asset defense, 1:1 segregated cold vault custody, and market-neutral algorithmic arbitrage platform.';
                $dirty = true;
            }
            if (empty($settings->site_title) || $settings->site_title === $settings->site_name || str_contains(strtolower($settings->site_title), 'online trader')) {
                $settings->site_title = 'Asset Protection & Institutional Arbitrage';
                $dirty = true;
            }
            if (str_contains(strtolower($settings->site_name ?? ''), 'online trader')) {
                $settings->site_name = 'Tokenweb3 Network';
                $dirty = true;
            }
            if ($dirty) {
                try {
                    $settings->save();
                } catch (\Exception $e) {
                    // Fallback gracefully if database is locked or read-only
                }
            }
        }
        $terms =  TermsPrivacy::find(1);
        $moreset =  SettingsCont::find(1);

        View::share('settings', $settings);
        View::share('terms', $terms);
        View::share('moresettings', $moreset);
        View::share('mod', $settings->modules);
    }
}