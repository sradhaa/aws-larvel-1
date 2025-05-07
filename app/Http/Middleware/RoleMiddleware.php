<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
   //     echo '<pre>';print_r( auth()->user()->role);exit;
        if (auth()->check() && auth()->user()->role === $role) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Unauthorized access');
    }
}
