<?php

namespace App\Http\Middleware;

use Closure;

class AccessAdmin
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
        if ($request->user()->accessAdmin()) {
            return $next($request);
        }
        return abort(404);
    }
}
