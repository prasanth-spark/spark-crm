<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class LoggedIn
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        if(Session::get('id')!=null){
            return redirect('/admin/dashboard');
        }
        return $next($request);
    }
}
