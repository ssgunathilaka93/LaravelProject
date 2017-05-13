<?php

namespace App\Http\Middleware;

use Closure;

class AccessUserPages
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
		if (!(auth()->user()->hasRole('admin'))) {
            return redirect(config('backpack.base.route_prefix').'/logout');
        }
        return $next($request);
    }
}
