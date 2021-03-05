<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class sessionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('role')) {
            return redirect('/')->with('status', 'Please Login First');
        }
        return $next($request);
    }
}
