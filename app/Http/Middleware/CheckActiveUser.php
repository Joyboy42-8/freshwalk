<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()) {
            return redirect()->route("login")->withErrors("Veuillez vous connecter !");
        }

        if(!Auth::user()->is_active) {
            Auth::logout();
            return redirect()->route("login")->withErrors("Votre compte a été désactivé ! Veuillez contacter notre service client à cette adresse : lucasfalk70@gmail.com");
        }

        return $next($request);
    }
}
