<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BlockSearchBotsMiddleware
{
    /**
     * Known search engine bots, crawlers, and aggressive scrapers.
     *
     * @var array
     */
    protected $crawlerSignatures = [
        'googlebot',
        'bingbot',
        'slurp',
        'duckduckbot',
        'baiduspider',
        'yandexbot',
        'sogou',
        'exabot',
        'facebot',
        'facebookexternalhit',
        'ia_archiver',
        'semrushbot',
        'ahrefsbot',
        'mj12bot',
        'dotbot',
        'rogerbot',
        'seznambot',
        'screaming frog',
        'petalbot',
        'bytespider',
        'applebot',
        'yisouspider',
        'coccocbot',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $userAgent = strtolower($request->header('User-Agent', ''));

        foreach ($this->crawlerSignatures as $signature) {
            if (strpos($userAgent, $signature) !== false) {
                // Return 403 Forbidden with noindex header for any matching search engine crawler
                return response('Access Denied: Crawlers and search indexers are restricted on this host.', 403)
                    ->header('X-Robots-Tag', 'noindex, nofollow, noarchive, nosnippet, noimageindex')
                    ->header('Content-Type', 'text/plain');
            }
        }

        return $next($request);
    }
}
