<?php

namespace App\Http\Controllers\employee;

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

use Illuminate\Support\Facades\Session;

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

    
     /**
     * Show specified Team Attendance view.
     *
     * @return \Illuminate\Http\Response
     */
    public function teamAttendanceList()
    {
        $teamAttendance=$this->userdetails->where('user_id',Session::get('id'))->first();
        $teamId = $teamAttendance->team_id;

        $teamAttendance=$this->attendance->whereHas('attendanceToUserDetails', function ($query) use ($teamId) {
            $query->where('team_id',$teamId)->where('role_id',4);
        })->with('attendanceToUser','attendanceToUserDetails')->get(); 
        return view('employee/teamattendance/team-attendance', compact('teamAttendance'));
    }

      /**
     * Show specified Team Attendance view.
     *
     * @return \Illuminate\Http\Response
     */
    public function teamAbsentList()
    {
        $teamLead=$this->userdetails->where('user_id',Session::get('id'))->first();
        $teamId = $teamLead->team_id;

        $teamabsentList = $this->leaverequest->where('leave_type_id', '!=', 1)->whereHas('leaveToUserDetails', function ($query) use ($teamId) {
            $query->where('team_id',$teamId)->where('role_id',4);
        })->with('leaverequest', 'leaverequestUser', 'leaverequestUser.roleToUser', 'leaveToUserDetails.teamToUserDetails')->get();
        return view('employee/teamattendance/team-absent', compact('teamabsentList'));
    }

      /**
     * Show specified Team Attendance view.
     *
     * @return \Illuminate\Http\Response
     */
    public function teamPermissionlist()
    {
        $teamLead=$this->userdetails->where('user_id',Session::get('id'))->first();
        $teamId = $teamLead->team_id;

        $teamPermissionList = $this->leaverequest->where('leave_type_id', '=', 1)->whereHas('leaveToUserDetails', function ($query) use ($teamId) {
            $query->where('team_id',$teamId)->where('role_id',4);
        })->with('leaverequest', 'leaverequestUser', 'leaverequestUser.roleToUser', 'leaveToUserDetails.teamToUserDetails')->get();
        return view('employee/teamattendance/team-permission', compact('teamPermissionList'));
    }
}
