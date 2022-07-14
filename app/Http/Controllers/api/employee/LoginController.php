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
use DB;


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
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                DB::table('oauth_access_tokens')->where('user_id', $user->id)->delete();
                $token = $user->createToken('MyApp')->accessToken;
                $users = User::where('email',$request->email)->with('userDetail')->first();
                $role_id= $users->role_id;
                $permission = RolehasPermission::where('role_id',$role_id)->get();
                $data = array();
                $data['token'] = $token;
                $data['users'] = $users;
                $data['permission_list'] = $permission;
                return response()->json(['status'=>true,'message'=>'Login Successfull','data'=>$data]);

            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    }

}
