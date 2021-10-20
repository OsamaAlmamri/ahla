<?php

namespace App\Http\Middleware;

use Closure;
use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Auth;

class Admins
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            if (auth()->user()->active == 1 or \auth()->id() == 1) {
                return $next($request);
            }
            Auth::logout();
            abort(403);
        }


    }
}
