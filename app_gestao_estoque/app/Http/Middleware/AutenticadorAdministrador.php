<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AutenticadorAdministrador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->acesso == 'Admin') {
                return $next($request);
            } else {
                return redirect('/acesso-negado');
            }
        } else {
            return redirect('/login');
        }
    }
}
