<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(Auth::user() && Auth::user()->is_hot_bleep == 1){
            Auth::logout();
            return redirect('/login')->with('error','Your account is hot-bleep user. you cannot login');
        }
        if (Auth::guard($guard)->check() && Auth::user()->is_admin == 1) {
            return redirect()->route('admin.dashboard');
        }
        elseif (Auth::guard($guard)->check() && Auth::user()->is_admin == 0)
        {
            return redirect()->route('home');
        }
        else {
            return $next($request);
        }
    }
}
