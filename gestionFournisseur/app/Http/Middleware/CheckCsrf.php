<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

class CheckCsrf extends VerifyCsrfToken
{
    protected $except = [
        'logout',     
        'loginEmploye', 
    ];

}