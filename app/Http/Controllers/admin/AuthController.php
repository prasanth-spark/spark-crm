<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Request\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Rules\AdminMatchOldPassword;


class AuthController extends Controller
{

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginView()
    {
        try{
            return view('admin/login/main', [
                'layout' => 'login'
            ]);

        } catch (\Throwable $exception) {
            Log::info($exception->getMessage());
            }
    }

    /**
     * Authenticate login admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {       
        try{
            $admin = $this->user->where('email', $request->email)->where('role_id',1)->first();
            if ($admin && Hash::check($request->password, $admin->password)) {
                Session::put('id', $admin->id);
                return redirect('/admin/dashboard');
            } else {
                return back();
            }

        }catch (\Throwable $exception) {
            Log::info($exception->getMessage());
            }
    }

    /**
     * Logout admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
                                                                                                                                                      
        try{
            Session::flush();
            return redirect('/admin/login');
            
        }catch (\Throwable $exception) {
            Log::info($exception->getMessage());
            }
    }

     /**
     * Reset Password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adminResetForm()
    {   
        return view('admin/reset-password/admin-reset-form');
    }


     /**
     * update password
     * @param ResetPasswordRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function adminChangePassword(Request $request)
    {      
        $request->validate([
            'current_password' => ['required', new AdminMatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(Session::get('id'))->update(['password'=> Hash::make($request->new_password)]);
        return redirect('/admin/login');

    }
}
