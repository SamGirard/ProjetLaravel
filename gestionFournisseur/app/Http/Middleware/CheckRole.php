<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $employe = $request->user();

        if (!$employe) {
            logger('Aucun utilisateur connecté. Redirection vers login.');
            if (!$request->is('loginEmploye')) {
                return redirect()->route('loginEmploye');
            }
        } else {
            logger('Utilisateur connecté : ' . $employe->courriel);
            logger('Rôle de l\'employé : ' . $employe->role);
            if (!in_array($employe->role, $roles)) {
                logger('Rôle non autorisé. Redirection vers login.');
                return redirect()->route('loginEmploye');
            }
        }

        return $next($request);
    }
}


