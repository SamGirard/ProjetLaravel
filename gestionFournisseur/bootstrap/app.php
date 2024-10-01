<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\VerifyCsrfToken;

return Application::configure()
    ->withProviders()
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'CheckRole' => \App\Http\Middleware\CheckRole::class,
        ]);
        $middleware->web(replace: [
            VerifyCsrfToken::class,
        ]);
    })

    
    ->withExceptions(function (Exceptions $exceptions) {
    
    })->create();
