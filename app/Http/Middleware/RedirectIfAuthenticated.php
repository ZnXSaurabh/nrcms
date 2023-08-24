<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

use App\Providers\RouteServiceProvider;

use Illuminate\Support\Facades\Redirect;



class RedirectIfAuthenticated

{

    /**

     * Handle an incoming request.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \Closure  $next

     * @param  string|null  $guard

     * @return mixed

     */

    public function handle($request, Closure $next, $guard = null)

    {

        if (Auth::guard($guard)->check()) {

            if (Auth::user()->hasAnyRoles(['super-admin', 'sse', 'aden', 'den', 'sden', 'helpdesk'])) {

                return Redirect::to('management/dashboard');

            }



            return Redirect::to('user/dashboard');



        }     



        return $next($request);

    }

}

