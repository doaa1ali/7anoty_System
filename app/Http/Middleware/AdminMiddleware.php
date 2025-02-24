<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth as auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if(auth::check() && auth::user())
              return $next($request);
        else
            return redirect()->route('home.Database');
    }
}
