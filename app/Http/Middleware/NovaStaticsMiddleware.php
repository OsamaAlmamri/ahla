<?php

namespace App\Http\Middleware;

use Closure;

class NovaStaticsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->getMethod() === 'GET') {
            $routes = [
                //here your scripts routes
                //                '/vendor/nova/vendor.js',
                //                //here your styles routes
                //                '/vendor/nova/app.js',
                //                '/vendor/nova/app.js',
                //                '/vendor/nova/app.css',
                //                '/vendor/nova/app.css',
                //                '/uploads/logo-150.svg',
                //                '/nova-api/scripts/nova-apex-chart',

            ];
            if (\in_array($request->getRequestUri(), $routes, true)) {
                return app(SetCacheControl::class)
                    ->handle($request, static function ($request) use ($next) {
                        return $next($request);
                    }, 'private;max_age=3600;etag');
            }
        }

        return $next($request);
    }
}

