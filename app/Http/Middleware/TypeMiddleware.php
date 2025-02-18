<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth as auth;

class TypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth::check() && auth::user()->type==='admin')
               return response()->view('Layout.master');

        elseif(auth::check() && auth::user()->type==='creator')
        return response()->view('creatorLayout.master');
        else
            return $next($request);
    }
}
