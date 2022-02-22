<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\UserDetails;
use App\Models\AccountType;
use App\Models\BankDetails;
use App\Models\RoleModel;
use App\Models\TeamModel;
use App\Models\User;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct(UserDetails $userdetails, AccountType $accountType, BankDetails $bankdetails, RoleModel $rolemodel, TeamModel $teammodel, User $user)
    {
        $this->userdetails = $userdetails;
        $this->accountType = $accountType;
        $this->bankdetails = $bankdetails;
        $this->rolemodel   = $rolemodel;
        $this->teammodel   = $teammodel;
        $this->user        = $user;
    }
     /**
     * Show specified view.
     *
     * @return \Illuminate\Http\Response
     */
    public function attendanceList()
    {
             $teamList = $this->teammodel->get();
             return view('admin/attendance/attendance-list',compact('teamList'));
    }

      /**
     * Show Team List.
     *
     * @return \Illuminate\Http\Response
     */

     public function attendanceTeamList(Request $request)
     {
        $teamList= $this->userdetails->where('team_id',$request->team_name)->get();
        return view('admin/attendance/teamlist');
     }

}
