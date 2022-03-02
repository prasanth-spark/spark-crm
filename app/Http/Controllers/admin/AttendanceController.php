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
use App\Models\LeaveRequest;


use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct(UserDetails $userdetails, AccountType $accountType, BankDetails $bankdetails, RoleModel $rolemodel, TeamModel $teammodel, User $user, Attendance $attendance, LeaveRequest $leaverequest)
    {
        $this->userdetails = $userdetails;
        $this->accountType = $accountType;
        $this->bankdetails = $bankdetails;
        $this->rolemodel   = $rolemodel;
        $this->teammodel   = $teammodel;
        $this->user        = $user;
        $this->attendance  = $attendance;
        $this->leaverequest  = $leaverequest;
    }
    /**
     * Show specified view.
     *
     * @return \Illuminate\Http\Response
     */
    public function attendanceList()
    {
        $teamList = $this->teammodel->get();
        $attendanceList = $this->attendance->with('attendanceToUser', 'attendanceToUser.roleToUser', 'attendanceToUserDetails.teamToUserDetails')->get();
        return view('admin/attendance/attendance-list', compact('attendanceList', 'teamList'));
    }

    /**
     * Show Team List.
     *
     * @return \Illuminate\Http\Response
     */

    public function attendanceTeamList(Request $request)
    {
        $attendanceTeamList = $this->attendance->whereHas('attendanceToUserDetails', function ($query) use ($request) {
            $query->where('team_id', '=', $request->team_id);
        })->with('attendanceToUser', 'attendanceToUser.roleToUser', 'attendanceToUserDetails')->get();
        return view('admin/attendance/attendance-teamlist', compact('attendanceTeamList'));
    }


    /**
     * Show Absent List view.
     *
     * @return \Illuminate\Http\Response
     */
    public function absentList()
    {
        $teamList = $this->teammodel->get();
        $absentList = $this->leaverequest->where('leave_type_id', '!=', 1)->with('leaverequest', 'leaverequestUser', 'leaverequestUser.roleToUser', 'leaveToUserDetails.teamToUserDetails')->get();
        return view('admin/absent/absent-list', compact('teamList', 'absentList'));
    }


    /**
     * Show Permission List view.
     *
     * @return \Illuminate\Http\Response
     */
    public function permissionList()
    {
        $teamList = $this->teammodel->get();
        $permissionList = $this->leaverequest->where('leave_type_id', 1)->with('leaverequest', 'leaverequestUser', 'leaverequestUser.roleToUser', 'leaveToUserDetails.teamToUserDetails', 'permissionType')->get();
        return view('admin/absent/permission-list', compact('teamList', 'permissionList'));
    }

    /**
     * Team wise absent List view.
     *
     * @return \Illuminate\Http\Response
     */
    public function teamWiseabsentList($id)
    {
        $teamWiseabsentList = $this->leaverequest->where('leave_type_id','!=',1)->whereHas('leaveToUserDetails', function ($query) use ($id) {
            $query->where('team_id', '=', $id);
        })->with('leaverequest', 'leaverequestUser', 'leaverequestUser.roleToUser', 'leaveToUserDetails', 'permissionType')->get();
        return view('admin/absent/team-wise-absent-list', compact('teamWiseabsentList'));
    }

    /**
     * Team wise permission List view.
     *
     * @return \Illuminate\Http\Response
     */
    public function teamWisePermissionList(Request $request)
    {
        $teamWisePermissionList = $this->leaverequest->where('leave_type_id', 1)->whereHas('leaveToUserDetails', function ($query) use ($request) {
            $query->where('team_id', '=', $request->team_id);
        })->with('leaverequest', 'leaverequestUser', 'leaverequestUser.roleToUser', 'leaveToUserDetails', 'permissionType')->get();
        return view('admin/absent/team-wise-permission-list', compact('teamWisePermissionList'));
    }
}
