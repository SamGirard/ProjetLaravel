<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken; 

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
            'csrf' => \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
        ]);
    })

    
    ->withExceptions(function (Exceptions $exceptions) {
    
    })->create();
