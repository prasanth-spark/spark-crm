<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\UserDetails;
use App\Models\AccountType;
use App\Models\BankDetails;
use App\Models\RoleModel;
use App\Models\TeamModel;
use App\Models\User;
use App\Models\TaskSheet;


use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(UserDetails $userdetails, AccountType $accountType, BankDetails $bankdetails, RoleModel $rolemodel, TeamModel $teammodel, User $user , TaskSheet $tasksheet)
    {
        $this->userdetails      = $userdetails;
        $this->accountType      = $accountType;
        $this->bankdetails      = $bankdetails;
        $this->rolemodel        = $rolemodel;
        $this->teammodel        = $teammodel;
        $this->user             = $user;
        $this->tasksheet        = $tasksheet;

    }
     /**
     * Show specified view.
     *
     * @return \Illuminate\Http\Response
     */
    public function taskList()
    {
         $teamList = $this->teammodel->get();
         $taskList = $this->user->where('role_id','!=',1)->with('userDetail','userDetail.teamToUserDetails','roleToUser','userTask')->get();
         return view('admin/task/task-list',compact('teamList','taskList'));
    }

    /**
     * Task Details view.
     *
     * @return \Illuminate\Http\Response
     */
    public function taskDetails($id)
    {
         $taskList = $this->tasksheet->where('id',$id)->with('taskToUser','taskToUserDetails.teamToUserDetails','taskToUser.roleToUser')->first();
         return view('admin/task/task-details',compact('taskList'));
    }

      /**
     * Show Team List.
     *
     * @return \Illuminate\Http\Response
     */

     public function taskTeamList(Request $request)
     {
        
        $teamList= $this->tasksheet->whereHas('taskToUser.userDetail', function ($query) use($request){
                    $query->where('team_id','=',$request->team_id);
                    })->with(['taskToUser','taskToUser.roleToUser','taskToUser.userDetail'])->get();
        return view('admin/task/task-team-list',compact('teamList'));
     }

}
