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
        return view('admin/attendance/attendance-list', compact('teamList'));
    }

    /**
     * Attendance List Pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function attendanceListPagination(Request $request)
    {

        $fromdate = str_replace('/', '-', $request->from_date);
        $fromdateFormatChange = date("Y-m-d", strtotime($fromdate));

        $todate = str_replace('/', '-', $request->to_date);
        $todateFormatChange = date("Y-m-d", strtotime($todate));

        $team       =   $request->team_name;
        $attendanceList = $this->attendance->with('attendanceToUser', 'attendanceToUser.roleToUser', 'attendanceToUserDetails.teamToUserDetails');
        $limit = $request->iDisplayLength;
        $offset = $request->iDisplayStart;


        if ($request->sSearch != '') {
            $keyword = $request->sSearch;
            $attendanceList->whereHas('attendanceToUser', function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            });
            $attendanceList->orwhereHas('attendanceToUser.roleToUser', function ($q) use ($keyword) {
                $q->where('role', 'like', '%' . $keyword . '%');
            });
            $attendanceList->orwhereHas('attendanceToUserDetails.teamToUserDetails', function ($q) use ($keyword) {
                return $q->where('team', 'like', '%' . $keyword . '%');
            });
        }

        $total_data = $attendanceList->count();
        $attendanceList = $attendanceList->when(($limit != '-1' && isset($offset)),
            function ($q) use ($limit, $offset) {
                return $q->offset($offset)->limit($limit);
            }
        );

        if ($team) {
            $attendanceList = $attendanceList->whereHas('attendanceToUserDetails', function ($query) use ($team) {
                $query->where('team_id', '=', $team);
            });
        } elseif ($fromdateFormatChange && $todateFormatChange && $team) {
            $attendanceList = $attendanceList->whereBetween('date', [$fromdateFormatChange, $todateFormatChange])->whereHas('attendanceToUserDetails', function ($query) use ($team) {
                $query->where('team_id', '=', $team);
            });
        }
        $List = $attendanceList->get();
        $column = array();
        foreach ($List as $value) {

            $col['id'] = $offset + 1;
            $col['date'] = ($value->date) ? $value->date : "";
            $col['name'] = $value->attendanceToUser->name;
            $col['team'] = $value->attendanceToUserDetails->teamToUserDetails->team;
            $col['role'] = $value->attendanceToUser->roleToUser->role;
            $col['status'] = ($value->attendance_status == 1) ? "present" : "absent";

            array_push($column, $col);
            $offset++;
        }
        $List['sEcho'] = $request->sEcho;
        $List['aaData'] = $column;
        $List['iTotalRecords'] = $total_data;
        $List['iTotalDisplayRecords'] = $total_data;


        return json_encode($List);
    }

    /**
     * Show Absent List view.
     *
     * @return \Illuminate\Http\Response
     */
    public function absentList()
    {
        $teamList = $this->teammodel->get();
        return view('admin/absent/absent-list', compact('teamList'));
    }



    /**
     * Absent List Pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function absentListPagination(Request $request)
    {
        $fromdate = str_replace('/', '-', $request->from_date);
        $fromdateFormatChange = date("Y-m-d", strtotime($fromdate));

        $todate = str_replace('/', '-', $request->to_date);
        $todateFormatChange = date("Y-m-d", strtotime($todate));
        $team       =   $request->team_name;
        $absentList = $this->leaverequest->where('leave_type_id', '!=', 1)->with('leaverequest', 'leaverequestUser', 'leaverequestUser.roleToUser', 'leaveToUserDetails.teamToUserDetails');
        $limit = $request->iDisplayLength;
        $offset = $request->iDisplayStart;


        if ($request->sSearch != '') {
            $keyword = $request->sSearch;
            $absentList->whereHas('leaverequestUser', function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')->where('leave_type_id', '!=', 1);
            });
            $absentList->orwhereHas('leaverequestUser.roleToUser', function ($q) use ($keyword) {
                $q->where('role', 'like', '%' . $keyword . '%')->where('leave_type_id', '!=', 1);
            });
            $absentList->orwhereHas('leaveToUserDetails.teamToUserDetails', function ($q) use ($keyword) {
                return $q->where('team', 'like', '%' . $keyword . '%')->where('leave_type_id', '!=', 1);
            });
        }

        $total_data = $absentList->count();
        $absentList = $absentList->when(($limit != '-1' && isset($offset)),
            function ($q) use ($limit, $offset) {
                return $q->offset($offset)->limit($limit);
            }
        );

        if ($fromdateFormatChange && $todateFormatChange && $team) {
            $absentList = $absentList->where('start_date', '<=', $fromdateFormatChange)
                ->where('end_date', '>=', $todateFormatChange)->whereHas('leaveToUserDetails', function ($query) use ($team) {
                    $query->where('team_id', '=', $team);
                });
        } elseif ($team) {
            $absentList = $absentList->whereHas('leaveToUserDetails', function ($query) use ($team) {
                $query->where('team_id', '=', $team);
            });
        }
        $List = $absentList->get();
        $column = array();
        foreach ($List as $value) {

            switch ($value->leave_status) {
                case ($value->leave_status == 1):
                    $leaveStatus = 'pending';
                    break;

                case ($value->leave_status == 2):
                    $leaveStatus = 'approved';
                    break;

                default:
                    $leaveStatus = 'rejected';
            }

            $col['id'] = $offset + 1;
            $col['name'] = $value->leaverequestUser->name;
            $col['team'] = $value->leaveToUserDetails->teamToUserDetails->team;
            $col['role'] = $value->leaverequestUser->roleToUser->role;
            $col['leave_type'] = $value->leaverequest->leave_type;
            $col['leave_status'] = $leaveStatus;
            $col['start_date'] = $value->start_date;
            $col['end_date'] = $value->end_date;

            array_push($column, $col);
            $offset++;
        }
        $List['sEcho'] = $request->sEcho;
        $List['aaData'] = $column;
        $List['iTotalRecords'] = $total_data;
        $List['iTotalDisplayRecords'] = $total_data;


        return json_encode($List);
    }


    /**
     * Show Permission List view.
     *
     * @return \Illuminate\Http\Response
     */
    public function permissionList()
    {
        $teamList = $this->teammodel->get();
        return view('admin/absent/permission-list', compact('teamList'));
    }

    /**
     * Permission List Pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function permissionListPagination(Request $request)
    {
        $fromdate = str_replace('/', '-', $request->from_date);
        $fromdateFormatChange = date("Y-m-d", strtotime($fromdate));

        $todate = str_replace('/', '-', $request->to_date);
        $todateFormatChange = date("Y-m-d", strtotime($todate));
        $team       =   $request->team_name;
        $permissionList = $this->leaverequest->where('leave_type_id',  1)->with('leaverequest', 'leaverequestUser', 'leaverequestUser.roleToUser', 'leaveToUserDetails.teamToUserDetails', 'permissionType');
        $limit = $request->iDisplayLength;
        $offset = $request->iDisplayStart;


        if ($request->sSearch != '') {
            $keyword = $request->sSearch;
            $permissionList->whereHas('leaverequestUser', function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')->where('leave_type_id',  1);
            });
            $permissionList->orwhereHas('leaverequestUser.roleToUser', function ($q) use ($keyword) {
                $q->where('role', 'like', '%' . $keyword . '%')->where('leave_type_id',  1);
            });
            $permissionList->orwhereHas('leaveToUserDetails.teamToUserDetails', function ($q) use ($keyword) {
                return $q->where('team', 'like', '%' . $keyword . '%')->where('leave_type_id',  1);
            });
        }

        $total_data = $permissionList->count();
        $permissionList = $permissionList->when(($limit != '-1' && isset($offset)),
            function ($q) use ($limit, $offset) {
                return $q->offset($offset)->limit($limit);
            }
        );

        if ($team) {
            $permissionList = $permissionList->whereHas('leaveToUserDetails', function ($query) use ($team) {
                $query->where('team_id', '=', $team);
            });
        } elseif ($fromdateFormatChange && $todateFormatChange && $team) {
            $permissionList = $permissionList->whereBetween('created_at', [$fromdateFormatChange, $todateFormatChange])->whereHas('leaveToUserDetails', function ($query) use ($team) {
                $query->where('team_id', '=', $team);
            });
        }
        $List = $permissionList->get();
        $column = array();
        foreach ($List as $value) {

            switch ($value->leave_status) {
                case ($value->leave_status == 0):
                    $leaveStatus = 'permission received';
                    break;

                case ($value->leave_status == 1):
                    $leaveStatus = 'permission accepted';
                    break;
                case ($value->leave_status == 2):
                    $leaveStatus = ' permission rejected';
                    break;

                default:
                    $leaveStatus = 'permission denied';
            }

            $col['id'] = $offset + 1;
            $col['created_at']   =  $value->created_at->todatestring();
            $col['name'] = $value->leaverequestUser->name;
            $col['team'] = $value->leaveToUserDetails->teamToUserDetails->team;
            $col['role'] = $value->leaverequestUser->roleToUser->role;
            $col['leave_type'] = $value->leaverequest->leave_type;
            $col['permission_status'] = $leaveStatus;
            $col['permission_hours_from'] = $value->permission_hours_from;
            $col['permission_hours_to'] = $value->permission_hours_to;
            $col['permission_hours'] = ($value->permissionType) ? $value->permissionType->permission_hours : "";



            array_push($column, $col);
            $offset++;
        }
        $List['sEcho'] = $request->sEcho;
        $List['aaData'] = $column;
        $List['iTotalRecords'] = $total_data;
        $List['iTotalDisplayRecords'] = $total_data;


        return json_encode($List);
    }
}
