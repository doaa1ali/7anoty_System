<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth as auth;

class TypeMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {

        if(!auth::check())
        {
            return redirect()->route('auth.login');
        }
        else
        {

            if(auth::check() && auth::user()->type==='admin')
            {
                return $next($request);
            }
                    
            elseif(auth::check() && auth::user()->type==='creator')
            {
                return response()->view('Layout_home.master');
            }
                
            else
            {
                return response()->view('Layout_home.master');
            }
               
        }
    }
}
