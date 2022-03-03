<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
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


use Illuminate\Http\Request;

class TeamTaskController extends Controller
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
     * Show specified Team Task view.
     *
     * @return \Illuminate\Http\Response
     */
    public function teamTask()
    {
        $teamTask=$this->userdetails->where('user_id',Session::get('id'))->first();
        $teamId = $teamTask->team_id;

        $taskSheet=$this->tasksheet->whereHas('taskToUserDetails', function ($query) use ($teamId) {
            $query->where('team_id',$teamId)->where('role_id',4);
        })->with('taskToUser','taskToUserDetails')->get(); 
        return view('employee/teamtask/teamtask-list', compact('taskSheet'));
    }

}
