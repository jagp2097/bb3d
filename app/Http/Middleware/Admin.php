<?php

namespace bagrap\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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

            if (!Auth::user()->isAdmin()) {

                if(session()->has('cart-whout')) session()->forget('cart-whout');

                return $next($request);

            }
        }

        return redirect('/user/perfil');

    }
}
