<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

/*
|--------------------------------------------------------------------------
| Emergency Encryption Key Fallback
|--------------------------------------------------------------------------
| If the environment key is missing, we force a fallback here to prevent 
| the application from crashing before it even starts.
*/
if (!isset($_ENV['APP_KEY']) || empty($_ENV['APP_KEY'])) {
    $_ENV['APP_KEY'] = 'base64:/aZvyvInK59QZuNrCtp0kMhTlF1wr/2LM9bBwYbQwKo=';
}

return Application::configure(basePath: dirname(__DIR__))

    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\EnsureUserHasRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
