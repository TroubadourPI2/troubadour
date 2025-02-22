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
        //dd($user->role->nom);

        if (!$user) {
          if (!$request->is('login')) {
            return redirect()->route('login');
          }
        } else {
          if (!in_array($user->role->nom, $roles)) {
            return redirect()->route('login');
          }
        }
        return $next($request);
    }
}
