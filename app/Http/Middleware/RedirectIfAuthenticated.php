<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'admin':

                if (Auth::guard($guard)->check()) {
                    return redirect()->route('admin.dashboard')->with('flash', 'You are logged in as Admin.');
                }

                break;

            default:

                if (Auth::guard($guard)->check()) {
                    return redirect(RouteServiceProvider::HOME)->with('flash', 'You are logged in as User.');
                }

                break;
        }

        return $next($request);
    }
}
