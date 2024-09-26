<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Support\Facades\Auth;

class CheckRole extends ValidateCsrdToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $employe = $request->user(); 

        if (!$employe) {
            if (!$request->is('loginEmploye')) {
                return redirect()->route('loginEmploye');
            }
        } else {
            if (!in_array($employe->role, $roles)) {
                return redirect()->route('loginEmploye');
            }
        }

        if($request->route()->named('logout')) {

            if (!Auth::check() || Auth::guard()->viaRemember()) {

                $this->except[] = 'logout';
                
            }   
        }

        return parent::handle($request, $next);
    }
}
