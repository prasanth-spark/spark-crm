<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\UserDetails;
use App\Models\AccountType;
use App\Models\BankDetails;
use App\Models\RoleModel;
use App\Models\TeamModel;
use App\Models\User;
use App\Models\Attendance;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct(UserDetails $userdetails, AccountType $accountType, BankDetails $bankdetails, RoleModel $rolemodel, TeamModel $teammodel, User $user,Attendance $attendance)
    {
        $this->userdetails = $userdetails;
        $this->accountType = $accountType;
        $this->bankdetails = $bankdetails;
        $this->rolemodel   = $rolemodel;
        $this->teammodel   = $teammodel;
        $this->user        = $user;
        $this->attendance  = $attendance;

    }
     /**
     * Show specified view.
     *
     * @return \Illuminate\Http\Response
     */
    public function attendanceList()
    {
             $teamList = $this->teammodel->get();
             $attendanceList = $this->attendance->with('attendanceToUser','attendanceToUser.roleToUser','attendanceToUserDetails.teamToUserDetails')->get();
             return view('admin/attendance/attendance-list',compact('attendanceList','teamList'));
    }

      /**
     * Show Team List.
     *
     * @return \Illuminate\Http\Response
     */

     public function attendanceTeamList(Request $request)
     {
        $attendanceTeamList= $this->attendance->whereHas('attendanceToUserDetails', function ($query) use($request){
            $query->where('team_id','=',$request->team_id);
            })->with('attendanceToUser','attendanceToUser.roleToUser','attendanceToUserDetails')->get();
        return view('admin/attendance/attendance-teamlist',compact('attendanceTeamList'));
     }

}
