<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AccessAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     *    have to register in kernal.php also = 'auth.admin' => \App\Http\Middleware\AccessAdmin::class,
     * this also protects who can go to the admin section - if they have this role
     *
     *
     */
    public function handle(Request $request, Closure $next)
    {

        if(Auth::user()->hasAnyRoles(['admin', 'viewOnlyAdmin'])) {
            return $next($request);
        }
        return redirect('/DASHBOARD');
    }
}
