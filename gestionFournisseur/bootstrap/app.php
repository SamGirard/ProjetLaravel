<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\VerifyCsrfToken;


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
        $middleware->web([

        ]);
    })

    
    ->withExceptions(function (Exceptions $exceptions) {
    
    })->create();
