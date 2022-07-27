<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\UserDetails;
use App\Models\AccountType;
use App\Models\BankDetails;
use Spatie\Permission\Models\Role;
use App\Models\TeamModel;
use App\Models\User;
use App\Models\Attendance;
use App\Models\LeaveRequest;


use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct(UserDetails $userdetails, AccountType $accountType, BankDetails $bankdetails, Role $rolemodel, TeamModel $teammodel, User $user, Attendance $attendance, LeaveRequest $leaverequest)
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
        $attendanceList = $this->attendance->with('attendanceToUser', 'attendanceToUser.roleToUser', 'attendanceToUser.teamToUser');
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
            $attendanceList->orwhereHas('attendanceToUser.teamToUser', function ($q) use ($keyword) {
                return $q->where('team', 'like', '%' . $keyword . '%');
            });
        }

        $total_data = $attendanceList->count();
        $attendanceList = $attendanceList->when(($limit != '-1' && isset($offset)),
            function ($q) use ($limit, $offset) {
                return $q->offset($offset)->limit($limit);
            }
        );

       if ($fromdateFormatChange && $todateFormatChange && $team) {
            $attendanceList = $attendanceList->whereBetween('date', [$fromdateFormatChange, $todateFormatChange])->whereHas('attendanceToUser', function ($query) use ($team) {
                $query->where('team_id', '=', $team);
            });
        }
        elseif($team) {
            $attendanceList = $attendanceList->whereHas('attendanceToUser', function ($query) use ($team) {
                $query->where('team_id', '=', $team);
            });
        }
        $List = $attendanceList->latest()->get();
        $column = array();
        foreach ($List as $value) {

            $col['id'] = $offset + 1;
            $col['date'] = ($value->date) ? $value->date : "";
            $col['name'] = $value->attendanceToUser->name;
            $col['team'] = $value->attendanceToUser->teamToUser->team;
            $col['role'] = $value->attendanceToUser->roleToUser->name;
            if($value->attendance == 1){
             $status = "Present";
            }elseif($value->attendance == 0 && $value->in_active == 1){
                $status = "Permission";
            }
            elseif($value->attendance == 0 && $value->in_active == 2){
                $status = "Leave Permission";
            }else{
                $status = "Absent"; 
            } 
          $col['status'] = $status;
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
        $teamList = $this->teammodel->latest()->get();
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
        $absentList = $this->leaverequest->where('leave_type_id', '!=', 1)->with('leaverequest', 'leaverequestUser', 'leaverequestUser.roleToUser', 'leaverequestUser.teamToUser');
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
            $absentList->orwhereHas('leaverequestUser.teamToUser', function ($q) use ($keyword) {
                return $q->where('team', 'like', '%' . $keyword . '%')->where('leave_type_id', '!=', 1);
            });
        }

        $total_data = $absentList->count();
        $absentList = $absentList->when(($limit != '-1' && isset($offset)),
            function ($q) use ($limit, $offset) {
                return $q->offset($offset)->limit($limit);
            }
        );

        if($fromdateFormatChange && $todateFormatChange && $team) {
            $absentList = $absentList->where('start_date', '<=', $fromdateFormatChange)
                ->where('end_date', '>=', $todateFormatChange)->whereHas('leaverequestUser', function ($query) use ($team) {
                    $query->where('team_id', '=', $team);
                });

        }elseif($team){
            $absentList = $absentList->whereHas('leaverequestUser', function ($query) use ($team) {
                $query->where('team_id', '=', $team);
            });
        }
        $List = $absentList->latest()->get();
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
            $col['team'] = $value->leaverequestUser->teamToUser->team;
            $col['role'] = $value->leaverequestUser->roleToUser->name;
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
        $teamList = $this->teammodel->latest()->get();
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
        $permissionList = $this->leaverequest->where('leave_type_id',  1)->with('leaverequest', 'leaverequestUser', 'leaverequestUser.roleToUser', 'leaverequestUser.teamToUser', 'permissionType');
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
            $permissionList->orwhereHas('leaverequestUser.teamToUser', function ($q) use ($keyword) {
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
            $permissionList = $permissionList->whereHas('leaverequestUser', function ($query) use ($team) {
                $query->where('team_id', '=', $team);
            });
        } elseif ($fromdateFormatChange && $todateFormatChange && $team) {
            $permissionList = $permissionList->whereBetween('created_at', [$fromdateFormatChange, $todateFormatChange])->whereHas('leaverequestUsers', function ($query) use ($team) {
                $query->where('team_id', '=', $team);
            });
        }
        $List = $permissionList->latest()->get();
        $column = array();
        foreach ($List as $value) {
             if($value->permission_status != null )
             {
            switch ($value->permission_status) {
                case ($value->permission_status == 0):
                    $leaveStatus = 'Permission Received';
                    break;

                case ($value->permission_status == 1):
                    $leaveStatus = 'Permission Approved';
                    break;

                case ($value->permission_status == 2):
                    $leaveStatus = 'Permission Rejected';
                    break;

                case ($value->permission_status == 3):
                        $leaveStatus = 'Permission Deny';
                        break;   
                default:
                    $leaveStatus = 'Permission ';
            }

        }else{

            switch ($value->leave_status) {
                case ($value->leave_status == 0):
                    $leaveStatus = 'Received';
                    break;

                case ($value->leave_status == 1):
                    $leaveStatus = 'Pending';
                    break;

                case ($value->leave_status == 2):
                    $leaveStatus = 'Approved';
                    break;

                case ($value->leave_status == 3):
                     $leaveStatus = 'Rejected';
                      break;

                default:
                    $leaveStatus = 'Denied';
            }
        }
            $col['id'] = $offset + 1;
            $col['created_at']   =  $value->created_at->todatestring();
            $col['name'] = $value->leaverequestUser->name;
            $col['team'] = $value->leaverequestUser->teamToUser->team;
            $col['role'] = $value->leaverequestUser->roleToUser->name;
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
