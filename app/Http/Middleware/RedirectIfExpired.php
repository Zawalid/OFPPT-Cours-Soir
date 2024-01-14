<?php

// app/Http/Middleware/RedirectIfExpired.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;

class RedirectIfExpired
{
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (TokenMismatchException $e) {
            // Redirect to the home page when a 419 error occurs
            return redirect()->route('home');
        }
    }
}
