<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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

            $user = Auth::user();
            //print_r($user);
            // if($user->role=='admin')
            //     Tenanti::driver('user')->asDefaultConnection($user, 'timeattendancesystem');

            // else{
            //     $company = App\Company::findOrFail($user->associated_company);

            //     Tenanti::driver('company')->asDefaultConnection($company, 'cas_{company_id}');
            // }
            return redirect('/home');
        }

        return $next($request);
    }
}
