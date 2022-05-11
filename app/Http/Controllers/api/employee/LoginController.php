<?php

namespace App\Http\Controllers\api\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\RoleModel;
use App\Http\Request\RegisterRequest;
use App\Http\Request\LoginRequest;
use App\Http\Request\ForgotPasswordRequest;
use App\Jobs\WelcomeEmailJob;
use App\Jobs\ForgotPassword;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class LoginController extends Controller
{
    public function __construct(User $user, RoleModel $rolemodel ,UserDetails $userdetails)
    {
        $this->user = $user;
        $this->rolemodel = $rolemodel;
        $this->userdetails = $userdetails;

    }
    public function loginEmployee(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                
                $token = $user->createToken('MyApp')->accessToken;
                $users = User::where('email',$request->email)->with('userDetail')->first();
                $data = [$token,$users];
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
