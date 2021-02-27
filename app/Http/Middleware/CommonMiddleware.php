<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CommonMiddleware
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
        if (Auth::user()->position == "admin"||Auth::user()->position == 'cashier') {
            return $next($request);
        }else{
            return redirect()->back();
        }
    }
}
