<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Auth;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards){
        if(empty($guards)) {
            if (!Auth::guard('web')->check()) {
                return redirect()->route('admin.login');
            }
        }else{
            $guard = $guards[0];
            switch (@$guard) {
                case 'web':
                    if (!Auth::guard($guard)->check()) {
                        return redirect()->route('admin.login');
                    }
                    break;
                case 'client':
                    if (!Auth::guard("client")->check()) {
                        return redirect()->route('login');
                    }
                    break;
                /*case 'visitor':
                    if (!Auth::guard("visitor")->check()) {
                        return redirect()->route("website.login", [request("website_slug"), request("frontLang")]);
                    }
                    break;*/
                default:
                    if (!Auth::guard($guard)->check()) {
                        return redirect('/home');
                    }
                    break;
            }
        }

        return $next($request);
    }
}
