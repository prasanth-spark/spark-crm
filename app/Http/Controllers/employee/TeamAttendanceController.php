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
    public function teamAttendance()
    {
        $teamAttendance=$this->userdetails->where('user_id',Session::get('id'))->first();
        $teamId = $teamAttendance->team_id;

        $teamAttendance=$this->attendance->whereHas('attendanceToUserDetails', function ($query) use ($teamId) {
            $query->where('team_id',$teamId)->where('role_id',4);
        })->with('attendanceToUser','attendanceToUserDetails')->get(); 
        // dd($teamAttendance);
        return view('employee/teamattendance/team-attendance', compact('teamAttendance'));
    }
}
