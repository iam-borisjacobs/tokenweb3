<?php

class LocalValetDriver extends \Valet\Drivers\ValetDriver
{
    /**
     * Determine if this driver serves the request.
     */
    public function serves(string $sitePath, string $siteName, string $uri): bool
    {
        return file_exists($sitePath . '/index.php');
    }

    /**
     * Determine if the incoming request is for a static file.
     * Deny direct serving of root sensitive files (.env, git, composer, artisan, sql dumps).
     */
    public function isStaticFile(string $sitePath, string $siteName, string $uri)
    {
        // Block sensitive files
        if (preg_match('#^/(\.env|\.git|\.lic|composer\.|package|artisan|.*\.(sql|bak|log))#i', $uri)) {
            return false;
        }

        // Only allow static assets from public asset directories
        if (preg_match('#^/(assets|volkovdesign|storage|temp|favicons|dash|dash2|purpose|admiro|css|js|error)/#i', $uri)) {
            $path = $sitePath . $uri;
            if (is_file($path)) {
                return $path;
            }
        }

        // Root favicon or robots
        if (preg_match('#^/(favicon\.ico|robots\.txt)$#i', $uri)) {
            $path = $sitePath . $uri;
            if (is_file($path)) {
                return $path;
            }
        }

        return false;
    }

    /**
     * Get the fully resolved path to the application's front controller.
     */
    public function frontControllerPath(string $sitePath, string $siteName, string $uri): ?string
    {
        return $sitePath . '/index.php';
    }
}
