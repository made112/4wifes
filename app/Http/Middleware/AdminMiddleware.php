<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->name == 'admin') {
            return $next($request); // User is an admin, continue with the request
        }

        return redirect()->route('login'); // Redirect to the login page
    }
}
