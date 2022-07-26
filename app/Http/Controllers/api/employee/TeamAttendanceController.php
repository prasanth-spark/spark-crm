<?php

namespace App\Http\Controllers\api\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserDetails;
use App\Models\AccountType;
use App\Models\BankDetails;
use Spatie\Permission\Models\Role;
use App\Models\TeamModel;
use App\Models\User;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\TaskSheet;
use Illuminate\Support\Facades\Auth;

class TeamAttendanceController extends Controller
{
    public function __construct(UserDetails $userdetails, AccountType $accountType, BankDetails $bankdetails, Role $rolemodel, TeamModel $teammodel, User $user, Attendance $attendance, LeaveRequest $leaverequest,TaskSheet $tasksheet)
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
        $this->middleware('permission:team-attendance,api', ['only' => ['teamAttendanceList','teamAbsentList','teamPermissionlist']]);

    }

    /*
     Team Attendance List
    */

    public function teamAttendanceList(Request $request)
    {
        $teamAttendance=$this->user->where('id',$request->user_id)->first();
        $teamId = $teamAttendance->team_id;
        $userId = $request->user_id;

        $teamAttendance=$this->attendance->whereHas('attendanceToUser', function ($query) use ($teamId,$userId) {
            $query->where('team_id',$teamId)->where('user_id','!=',$userId);
        })->with('attendanceToUser')->get(); 
        return response()->json(['status'=>true,'message'=>'Team Attendance Details','data'=>$teamAttendance]);
    }

    /*
     Team Absent List
    */

    public function teamAbsentlist(Request $request)
    {
        $teamLead=$this->user->where('id',$request->user_id)->first();
        $teamId = $teamLead->team_id;
        $userId = $request->user_id;
        $teamabsentList = $this->leaverequest->where('leave_type_id', '!=', 1)->whereHas('leaverequestUser', function ($query) use ($teamId,$userId) {
            $query->where('team_id',$teamId)->where('user_id','!=',$userId);
        })->with('leaverequest', 'leaverequestUser', 'leaverequestUser.roleToUser','leaverequestUser.teamToUser')->get();
        return response()->json(['status'=>true,'message'=>'Team Absent Members Details','data'=>$teamabsentList]);
    }

    /*
     Team Permission List
    */

    public function teamPermissionlist(Request $request)
    {
        $teamLead=$this->user->where('id',$request->user_id)->first();
        $teamId = $teamLead->team_id;
        $userId = $request->user_id;
        $teamPermissionList = $this->leaverequest->where('leave_type_id', '=', 1)->whereHas('leaverequestUser', function ($query) use ($teamId,$userId) {
            $query->where('team_id',$teamId)->where('user_id','!=',$userId);
        })->with('leaverequest', 'leaverequestUser', 'leaverequestUser.roleToUser')->get();
        return response()->json(['status'=>true,'message'=>'Team Absent Members Details','data'=>$teamPermissionList]);
    }
}
