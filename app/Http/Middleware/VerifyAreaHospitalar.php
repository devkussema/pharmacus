<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyAreaHospitalar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && (auth()->user()->farmacia || auth()->user()->isFarmacia)) {
            if (auth()->user()->isFarmacia or auth()->user()->farmacia->farmacia->status == 1) {
                return $next($request);
            }else{
                Auth::logout();
                return redirect()->route('login')->with('error', "Algo deu errado. Por alguma razão a farmácia encontra-se inativa. Por favor entre em contato com o webmaster.");
            }
        }

        return redirect()->route('home')->with('warning', 'Não tens permissão para acessar esta página.');
    }
}
