<?php

namespace App\Http\Controllers\api\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use Spatie\Permission\Models\Role;
use App\Models\RolehasPermission;
use App\Http\Request\RegisterRequest;
use App\Http\Request\LoginRequest;
use App\Http\Request\ForgotPasswordRequest;
use App\Jobs\WelcomeEmailJob;
use App\Jobs\ForgotPassword;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{
    public function __construct(User $user, Role $rolemodel ,UserDetails $userdetails)
    {
        $this->user = $user;
        $this->rolemodel = $rolemodel;
        $this->userdetails = $userdetails;

    }

    /*
     Employee Login API
    */

    public function loginEmployee(Request $request)
    {
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Hash::check($request->password, Auth::user()->password)) {
                $token = Auth::user()->createToken('MyApp')->accessToken;        //         
                        $role_id= Auth::user()->role_id;
                        $permission = RolehasPermission::where('role_id',$role_id)->get();
                        $users = User::where('email',$request->email)->with('userDetail')->first();
                        $data = array();
                        $data['token'] = $token;
                        $data['users'] = Auth::user();
                        $data['permission_list'] = $permission;
                        return response()->json(['status'=>true,'message'=>'Login Successfull','data'=>$data]);
    
            }else{
                $response = ["message" => "Password Mismatch"];
                return response($response, 422);
            }
        
        }else{
            return response()->json(['status'=>false,'message'=>'Login failed']);
        }
    }

}
