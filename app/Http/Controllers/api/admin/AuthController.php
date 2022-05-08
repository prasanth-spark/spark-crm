<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Request\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Rules\AdminMatchOldPassword;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function login(Request $request)
    {
        try{
            $admin = $this->user->where('email', $request->email)->where('role_id',1)->first();
            if ($admin && Hash::check($request->password, $admin->password)) {
            //   $data =  Session::put('id', $admin->id);
            $accessToken = $this->user->createToken('AuthToken')->accessToken;
            // dd($accessToken);
            User::where('email', '=',$request->email)->update(['auth_token' => $accessToken]);
                return response()->json(['status'=>true,'message'=>'Admin login successfully','data'=>$accessToken]);
            } else {
                return response()->json(['status'=>false,'message'=>'Admin login failed']);
            }

        }catch (\Throwable $exception) {
            Log::info($exception->getMessage());
            return response()->json(['status'=>false,'message'=>'Admin login Failed']);

            }
    }
    public function logout()
    {                                                                                                                                                  
        // try{
            // dd(Auth::id());
            $accessToken = auth()->user()->token();
           $token= $request->user()->tokens->find($accessToken);

            return response()->json(['status'=>true,'message'=>'Admin logout successfully']);

        // }catch (\Throwable $exception) {
        //     Log::info($exception->getMessage());
        //     return response()->json(['status'=>false,'message'=>'Admin logout failed']);
        //     }
    }
    public function adminChangePassword(Request $request)
    {      
        $request->validate([
            'current_password' => ['required', new AdminMatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(Session::get('id'))->update(['password'=> Hash::make($request->new_password)]);
        return response()->json(['status'=>true,'message'=>'Admin Password change successfully']);
    }
}
