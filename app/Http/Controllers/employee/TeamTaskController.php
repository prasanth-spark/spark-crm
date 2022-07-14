<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\UserDetails;
use App\Models\AccountType;
use App\Models\BankDetails;
use Spatie\Permission\Models\Role;
use App\Models\TeamModel;
use App\Models\User;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\TaskSheet;
use Illuminate\Support\Arr;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamTaskController extends Controller
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

        $this->middleware('permission:team-task', ['only' => ['teamTask']]);
    }

     /**
     * Show specified Team Task view.
     *
     * @return \Illuminate\Http\Response
     */
    public function teamTask()
    {
        $teamLead=$this->user->where('id',Auth::user()->id)->first();
        $teamUsers = $this->user->where('team_id', '=' ,$teamLead->team_id)->where('role_id', '!=' ,$teamLead->role_id)->get();
        $taskSheet= []; 
        foreach($teamUsers as $teamUser){
            $taskSheetDetail =$this->tasksheet->with('taskToUser')->whereHas('taskToUser', function ($query) use ($teamUser) {
                $query->where('user_id',$teamUser->id);
            })->latest()->get(); 
            array_push($taskSheet,$taskSheetDetail);
        }
        return view('employee/teamtask/teamtask-list', compact('taskSheet'));
    }

}
