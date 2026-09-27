<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Fast block for sensitive project files
$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?? '';
if (preg_match('#^/(\.env|\.git|\.lic|composer\.(json|lock)|package(-lock)?\.json|artisan|.*\.(sql|bak|log))$#i', $requestPath)) {
    http_response_code(404);
    exit('404 Not Found');
}

/*
|--------------------------------------------------------------------------
| Check If Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is maintenance / demo mode via the "down" command we
| will require this file so that any prerendered template can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists(__DIR__ . '/storage/framework/maintenance.php')) {
    require __DIR__ . '/storage/framework/maintenance.php';
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__ . '/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

try {
    $app = require_once __DIR__ . '/bootstrap/app.php';

    $kernel = $app->make(Kernel::class);

    $response = tap($kernel->handle(
        $request = Request::capture()
    ))->send();

    $kernel->terminate($request, $response);
} catch (\Throwable $e) {
    $envFile = __DIR__ . '/.env';
    $debug = false;
    if (file_exists($envFile)) {
        $env = file_get_contents($envFile);
        if (preg_match('/^APP_DEBUG=true/mi', $env)) {
            $debug = true;
        }
    }
    if ($debug || (isset($_GET['debug']) && $_GET['debug'] === '1')) {
        header('Content-Type: text/html; charset=utf-8');
        http_response_code(500);
        echo "<div style='font-family: monospace; background: #0d1117; color: #f85149; padding: 30px; line-height: 1.5;'>";
        echo "<h2 style='color: #ff7b72; margin-top: 0;'>Application Boot Error (HTTP 500)</h2>";
        echo "<p style='font-size: 16px; color: #f0f6fc;'><strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
        echo "<p style='color: #8b949e;'><strong>Location:</strong> " . htmlspecialchars($e->getFile()) . " on line " . $e->getLine() . "</p>";
        echo "<h3 style='color: #58a6ff;'>Stack Trace:</h3>";
        echo "<pre style='color: #c9d1d9; background: #161b22; padding: 15px; border-radius: 6px; overflow-x: auto; font-size: 13px;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
        echo "</div>";
        exit;
    }
    throw $e;
}