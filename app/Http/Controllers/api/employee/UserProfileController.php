<?php

namespace App\Http\Controllers\api\employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\AccountType;
use App\Models\BankDetails;
use App\Models\RoleModel;
use App\Models\TeamModel;
use App\Http\Request\UserProfileRequest;
use App\Models\LanguageSkill;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{

    public function __construct(UserDetails $userdetails, AccountType $accountType, BankDetails $bankdetails, RoleModel $rolemodel, TeamModel $teammodel, User $user)
    {
        $this->user        = $user;
        $this->userdetails = $userdetails;
        $this->accountType = $accountType;
        $this->bankdetails = $bankdetails;
        $this->rolemodel   = $rolemodel;
        $this->teammodel   = $teammodel;
    }

    public function userDetail(Request $request)
    {
        $userId = $requset->user_id;
        $userdetails = $this->userdetails->where('user_id', $userId)->with('bankNameToEmployee', 'accountTypeToEmployee', 'teamToUserDetails')->first();
        if (isset($userdetails)) {
            $bankName = $this->bankdetails->get();
            $accountType = $this->accountType->get();
            $team = $this->teammodel->get();
            $language = LanguageSkill::all();
            $data = array();
            $data['bankName'] = $bankName;
            $data['accountType'] = $accountType;
            $data['team'] = $team;
            $data['language'] = $language;   
            return response()->json(['status'=>true,'message'=>'User Details','user_details'=>$data]);
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
    public function userProfileAdd(UserProfileRequest $request)
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
                'role_id' => $user->role_id,
                'team_id' => $request->team_name,
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
            'role_id' => $user->role_id,
            'team_id' => $request->team_name,
        ]);
        return response()->json(['status'=>true,'message'=>'User Profile Created successfully']);
       }  
    }

    public function userChangePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        User::find($request->user_id)->update(['password'=> Hash::make($request->new_password)]);
        return response()->json(['status'=>true,'message'=>'User New Passord Created successfully']);
    }

    
}
