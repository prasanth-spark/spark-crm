<?php

namespace App\Http\Controllers\api\employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\AccountType;
use App\Models\BankDetails;
use Spatie\Permission\Models\Role;
use App\Models\TeamModel;
use App\Http\Request\UserProfileRequest;
use App\Models\LanguageSkill;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class UserProfileController extends Controller
{

    public function __construct(UserDetails $userdetails, AccountType $accountType, BankDetails $bankdetails, Role $rolemodel, TeamModel $teammodel, User $user)
    {
        $this->user        = $user;
        $this->userdetails = $userdetails;
        $this->accountType = $accountType;
        $this->bankdetails = $bankdetails;
        $this->rolemodel   = $rolemodel;
        $this->teammodel   = $teammodel;
        $this->middleware('permission:user-profile,api', ['only' => ['userDetail','userProfileAdd','userChangePassword']]);
    }

    public function userDetail(Request $request)
    {
        $userId = $request->user_id;
        $userdetails = $this->user->where('id', $userId)->with('userDetail','teamToUser')->first();
        if (isset($userdetails)) {
            $bankName = $this->bankdetails->get();
            $accountType = $this->accountType->get();
            $team = $this->teammodel->get();
            $language = LanguageSkill::all();
            $data = array();
            $data['user_detail'] = $userdetails;
            $data['bankName'] = $bankName;
            $data['accountType'] = $accountType;
            $data['team'] = $team;
            $data['language'] = $language;   
            return response()->json(['status'=>true,'message'=>'User Detail and Other details','data'=>$data]);
        }else{
            $bankName = $this->bankdetails->get();
            $accountType = $this->accountType->get();
            $team = $this->teammodel->get();
            $data = array();
            $data['bankName'] = $bankName;
            $data['accountType'] = $accountType;
            $data['team'] = $team;
            return response()->json(['status'=>true,'message'=>'User Details','user_details'=>$data]);
        }
    }
    public function userProfileAdd(Request $request)
    {
        $userID = $request->user_id;
        $user = $this->user->where('id', $userID)->first();
        $this->user->where('id',$user->id)->update([
            'team_id'=>$request->team_name,
            'status'=>1
      ]);
        $userdetails = $this->userdetails->where('user_id', $userID)->first();
        if(isset($userdetails)){
            $userdetails->update([
                'user_id' => $userID,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'phone_number' => $request->phone_number,
                'emergency_contact_number' => $request->emergency_contact_number,
                'official_email' => $request->official_email,
                'joined_date' => $request->joined_date,
                'home_address' => $request->home_address,
                'date_of_birth' => $request->date_of_birth,
                'blood_group' => $request->blood_group,
                'pan_number' => $request->pan_number,
                'aadhar_number' => $request->aadhar_number,
                'bank_id' => $request->bank_name,
                'account_holder_name'    => $request->account_holder_name,
                'account_number' => $request->account_number,
                'ifsc_code' => $request->ifsc_code,
                'branch_name' => $request->branch_name,
                'account_type_id' => $request->account_type,
                'status'=>'1',
            ]);
            return response()->json(['status'=>true,'message'=>'User Profile updated successfully']);
        }else{
        $this->userdetails->create([
            'user_id' => $user->id,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'phone_number' => $request->phone_number,
            'emergency_contact_number' => $request->emergency_contact_number,
            'official_email' => $request->official_email,
            'joined_date' => $request->joined_date,
            'home_address' => $request->home_address,
            'date_of_birth' => $request->date_of_birth,
            'blood_group' => $request->blood_group,
            'pan_number' => $request->pan_number,
            'aadhar_number' => $request->aadhar_number,
            'bank_id' => $request->bank_name,
            'account_holder_name'    => $request->account_holder_name,
            'account_number' => $request->account_number,
            'ifsc_code' => $request->ifsc_code,
            'branch_name' => $request->branch_name,
            'account_type_id' => $request->account_type,
        ]);
        return response()->json(['status'=>true,'message'=>'User Profile Created successfully']);
       }  
    }

    public function userChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required'],
            'new_password' => ['required'],
            'new_confirm_password' => 'required|same:new_password',
        ]);
        if($validator->fails()){ 
        return response()->json(['status'=>true,'message'=>'Pls Fill all Fields']);
         }else{
        $user = User::where('id',$request->user_id)->first();
        $password = $user->password;
        if(Hash::check($request->current_password,$password)){
        User::find($request->user_id)->update(['password'=> Hash::make($request->new_password)]);
        return response()->json(['status'=>true,'message'=>'User New Passord Created successfully']);
        }else{
        return response()->json(['status'=>true,'message'=>'Your Old Password is Incorrect']);
        }
       }
    }  
}
