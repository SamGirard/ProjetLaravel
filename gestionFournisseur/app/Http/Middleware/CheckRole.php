<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
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

        return $next($request);
    }
}
