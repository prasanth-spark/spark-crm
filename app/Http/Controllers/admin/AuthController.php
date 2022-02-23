<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Request\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;



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
}
