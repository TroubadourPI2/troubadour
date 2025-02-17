<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifierRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
          if (!$request->is('login')) {
           //retourner vers la page de connexion
          }
        } else {
          if (!in_array($user->role->nom, $roles)) {
             //retourner vers la page de connexion
          }
        }
        return $next($request);
    }
}
