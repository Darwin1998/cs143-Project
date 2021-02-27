<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class ManagerMiddleware
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
        if (Auth::user()->position == "admin"||Auth::user()->position == 'manager') {
            return $next($request);
        }

    }
}
