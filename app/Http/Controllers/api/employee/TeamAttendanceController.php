<?php

namespace App\Http\Controllers\api\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserDetails;
use App\Models\AccountType;
use App\Models\BankDetails;
use App\Models\RoleModel;
use App\Models\TeamModel;
use App\Models\User;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\TaskSheet;
use Illuminate\Support\Facades\Auth;

class TeamAttendanceController extends Controller
{
    public function __construct(UserDetails $userdetails, AccountType $accountType, BankDetails $bankdetails, RoleModel $rolemodel, TeamModel $teammodel, User $user, Attendance $attendance, LeaveRequest $leaverequest,TaskSheet $tasksheet)
    {
        $this->userdetails = $userdetails;
        $this->accountType = $accountType;
        $this->bankdetails = $bankdetails;
        $this->rolemodel   = $rolemodel;
        $this->teammodel   = $teammodel;
        $this->user        = $user;
        $this->attendance    = $attendance;
        $this->leaverequest  = $leaverequest;
        $this->tasksheet     = $tasksheet;
    }

    /*
     Team Attendance List
    */

    public function teamAttendanceList(Request $request)
    {
        $teamAttendance=$this->userdetails->where('user_id',$request->user_id)->first();
        $teamId = $teamAttendance->team_id;
        $teamAttendance=$this->attendance->whereHas('attendanceToUserDetails', function ($query) use ($teamId) {
            $query->where('team_id',$teamId)->where('role_id',4);
        })->with('attendanceToUser','attendanceToUserDetails')->get(); 
        return response()->json(['status'=>true,'message'=>'Team Attendance Details','data'=>$teamAttendance]);
    }

    /*
     Team Absent List
    */

    public function teamAbsentlist(Request $request)
    {
        $teamLead=$this->userdetails->where('user_id',$request->user_id)->first();
        $teamId = $teamLead->team_id;
        $teamabsentList = $this->leaverequest->where('leave_type_id', '!=', 1)->whereHas('leaveToUserDetails', function ($query) use ($teamId) {
            $query->where('team_id',$teamId)->where('role_id',4);
        })->with('leaverequest', 'leaverequestUser', 'leaverequestUser.roleToUser', 'leaveToUserDetails.teamToUserDetails')->get();
        return response()->json(['status'=>true,'message'=>'Team Absent Members Details','data'=>$teamabsentList]);
    }

    /*
     Team Permission List
    */

    public function teamPermissionlist(Request $request)
    {
        $teamLead=$this->userdetails->where('user_id',$request->user_id)->first();
        $teamId = $teamLead->team_id;
        $teamPermissionList = $this->leaverequest->where('leave_type_id', '=', 1)->whereHas('leaveToUserDetails', function ($query) use ($teamId) {
            $query->where('team_id',$teamId)->where('role_id',4);
        })->with('leaverequest', 'leaverequestUser', 'leaverequestUser.roleToUser', 'leaveToUserDetails.teamToUserDetails')->get();
        return response()->json(['status'=>true,'message'=>'Team Absent Members Details','data'=>$teamPermissionList]);
    }
}
