<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleModel;
use App\Http\Request\RegisterRequest;
use App\Http\Request\LoginRequest;
use App\Jobs\WelcomeEmailJob;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;





class LoginController extends Controller
{
    public function __construct(User $user, RoleModel $rolemodel)
    {
        $this->user = $user;
        $this->rolemodel = $rolemodel;
    }

    /**
     * Show RegisterForm view.
     *
     * @return \Illuminate\Http\Response
     */
    public function registerForm()
    {
        $role = $this->rolemodel->where('id','!=',1)->get();
        return view('employee/auth/employee-register-form', compact('role'));
    }


     /**
     *  Employee Register.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function registerEmployee($id)
    {
        $user = $this->user->where('id',$id)->first();
        return view('employee/user-dashboard',compact('user')); 
    }
    public function userDashboard(RegisterRequest $request)
    {
        $userCredentials = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status'=>'2',
            'role_id' => $request->role,
        ]);
        dispatch(new WelcomeEmailJob($userCredentials));

        return back()->with('success', 'Verify mail to get in!. Please wait for the admin approval');
    }

    /**
     * Show LoginForm view.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginForm()
    {
        return view('employee/auth/employee-login-form');
    }

    /**
     * Show MailUsing view LoginForm.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginFormMail($id)
    {
        $this->user->where('id', $id)->update([
            'email_verified_at' => now()
        ]);
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
        $employee = $this->user->where('email', $request->email)->where('role_id','!=',1)->where('status',1)->first();
        if ($employee && Hash::check($request->password, $employee->password) && !empty($employee->email_verified_at)) {
            session::put('id', $employee->id);
            session::put('name', $employee->name);
            return redirect('/employee/employee_dashboard');
        }else{
            return back();
        }
    }

    /**
     * Show Dashboard view.
     *
     * @return \Illuminate\Http\Response
     */
    public function employeeDashboard()
    {
        return view('/employee/user-dashboard');
    }

      /**
     * Logout user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Session::flush();
        return redirect('employee/login-form');
    }
}
