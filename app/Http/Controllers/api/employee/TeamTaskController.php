<?php

namespace App\Http\Controllers\api\employee;

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
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Illuminate\Http\Request;

class TeamTaskController extends Controller
{
    public function __construct(UserDetails $userdetails, AccountType $accountType, BankDetails $bankdetails, Role $rolemodel, TeamModel $teammodel, User $user, Attendance $attendance, LeaveRequest $leaverequest,TaskSheet $tasksheet,Project $project)
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
        $this->project    = $project;
        $this->middleware('permission:team-task,api', ['only' => ['teamTask']]);
    }
    
    /*
    Team Members Task Details
    */

    public function teamTask(Request $request)
    {
        $teamTask=$this->user->where('id',$request->user_id)->first();
        $teamId = $teamTask->team_id;
        $userId = $request->user_id;

        $taskSheets=$this->tasksheet->whereHas('taskToUser', function ($query) use ($teamId,$userId) {
            $query->where('team_id',$teamId)->where('user_id','!=',$userId);
        })->with('taskToUser','projects')->latest()->get(); 
        return response()->json(['status'=>true,'message'=>'Team Member Task Details','data'=>$taskSheets]);
    }

}
