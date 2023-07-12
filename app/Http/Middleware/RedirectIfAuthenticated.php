<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {

            if ($guard == "student" && Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::Student);
            } elseif ($guard == "admin" && Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            } elseif ($guard == "teacher" && Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::Teacher);
            } elseif ($guard == "parent" && Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::Parent);
            }
        }


        return $next($request);
    }
}
