<?php

namespace App\Http\Livewire\Admin;

use App\Models\Settings;
use Livewire\Component;

class ThemeDisplay extends Component
{
    public $site_accent_color = '#D61C4E';
    public $site_secondary_color = '#9F1239';
    public $hero_accent_color = '#F59E0B';
    public $hero_secondary_color = '#D97706';
    public $frontend_template = 'default';

    public function mount()
    {
        $settings = Settings::where('id', '1')->first();
        if ($settings) {
            $this->site_accent_color = $settings->site_accent_color ?: '#D61C4E';
            $this->site_secondary_color = $settings->site_secondary_color ?: '#9F1239';
            $this->hero_accent_color = $settings->hero_accent_color ?: '#F59E0B';
            $this->hero_secondary_color = $settings->hero_secondary_color ?: '#D97706';
            $this->frontend_template = $settings->frontend_template ?: 'default';
        }
    }

    public function setFrontendTemplate($template)
    {
        $this->frontend_template = $template;

        try {
            Settings::where('id', '1')->update([
                'frontend_template' => $template,
            ]);
        } catch (\Exception $e) {
            if (!\Illuminate\Support\Facades\Schema::hasColumn('settings', 'frontend_template')) {
                \Illuminate\Support\Facades\Schema::table('settings', function ($table) {
                    $table->string('frontend_template', 50)->default('default')->nullable();
                });
            }
            Settings::where('id', '1')->update([
                'frontend_template' => $template,
            ]);
        }

        $templateName = $template === 'ecx' ? 'ECX Groups Crypto Template' : 'Classic Institutional / Arbitrage Template';
        session()->flash('template_message', "Front-End Landing Page Template successfully switched to: {$templateName}!");
    }

    public function render()
    {
        return view('livewire.admin.theme-display', [
            'settings' => Settings::where('id', '1')->first(),
        ]);
    }

    public function setTheme($theme)
    {
        Settings::where('id', '1')
            ->update([
                'website_theme' => $theme,
            ]);
    }

    public function setPalettePreset($primary, $secondary)
    {
        $this->site_accent_color = $primary;
        $this->site_secondary_color = $secondary;
        $this->saveSitePalette();
    }

    public function saveSitePalette()
    {
        Settings::where('id', '1')
            ->update([
                'site_accent_color' => $this->site_accent_color,
                'site_secondary_color' => $this->site_secondary_color,
            ]);

        $this->dispatchBrowserEvent('site-palette-saved', [
            'primary' => $this->site_accent_color,
            'secondary' => $this->site_secondary_color,
        ]);

        session()->flash('site_palette_message', 'Global platform color palette and gradient updated successfully!');
    }

    public function saveHeroColors()
    {
        Settings::where('id', '1')
            ->update([
                'hero_accent_color' => $this->hero_accent_color,
                'hero_secondary_color' => $this->hero_secondary_color,
            ]);

        $this->dispatchBrowserEvent('hero-colors-saved', [
            'accent' => $this->hero_accent_color,
            'secondary' => $this->hero_secondary_color,
        ]);

        session()->flash('hero_color_message', 'Hero ambient and particle colors updated successfully!');
    }
}