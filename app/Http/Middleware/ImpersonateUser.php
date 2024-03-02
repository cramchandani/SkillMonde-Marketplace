<?php

namespace App\Http\Middleware;

use Closure;

class Impersonate
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated and a site administrator
        if (auth()->check() && auth()->user()->isSiteAdmin()) {
            return $next($request);
        }

        return redirect('/'); // Redirect to home page or any other page you want to show unauthorized users.
    }
}
