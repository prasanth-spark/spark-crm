<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EmployeeAuthenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle(Request $request, Closure $next)
    {
        //dd($request->session()->get('employee'));
        if (!is_null($request->session()->get('employee'))) {
            return $next($request);
        } else {
            return redirect('employee/login-form');
        }
    }
}
