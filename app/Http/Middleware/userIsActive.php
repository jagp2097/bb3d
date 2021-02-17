<?php

namespace bagrap\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class userIsActive
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

        if (!$request->user()->isActive()) 
        {
             return // redirect()->route('perfil.recover');
             Redirect::route('perfil.recover');
        }
            
        return $next($request);
    }
}
