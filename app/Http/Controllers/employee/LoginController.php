<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Request\RegisterRequest;
use App\Http\Request\LoginRequest;
use Hash;
use Session;




class LoginController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

     /**
     * Show RegisterForm view.
     *
     * @return \Illuminate\Http\Response
     */
    public function registerForm()
    {
        return view('employee/auth/employee-register-form'); 
    }

     /**
     *  Employee Register.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function registerEmployee(RegisterRequest $request)
    {
        $this->user->create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        return view('/employee/user-dashboard');
    }

     /**
     * Show RegisterForm view.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginForm()
    {
        return view('employee/auth/employee-login-form'); 
    }

     /**
     *  Employee Register.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginEmployee(LoginRequest $request)
    {
        $employee = $this->user->where('email',$request->email)->first();
        if ($employee && Hash::check($request->password, $employee->password)) {
            $request->session()->put('employee', $employee->email);
            return view('/employee/user-dashboard');
        }else{
            return back();
        }
    }
}
