<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {


        if (auth()->check() && in_array(auth()->user()->user_role, $roles)) {
            return $next($request);
        }

        if (!auth()->check()) {
            return redirect()->route('login.form');
        }

        switch (auth()->user()->user_role) {
            case 'etudiant':
                return redirect()->route('etudiant.dashboard');
            case 'professeur':
                return redirect()->route('etudiants.index');
            default:
                return abort(401);
        }
        abort(401);
    }
}