<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Jobs\AttendanceDetail;
use App\Jobs\LeavePermissionDetail;
use App\Jobs\LeaveMailSend;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\LeaveRequest;
use App\Models\Attendance;
use Carbon\Carbon;


class AttendanceController extends Controller
{ 
    public function __construct(User $user,UserDetails $userDetails,Attendance $attendance,LeaveRequest $leaveRequest)
    {
        $this->user =$user;
        $this->userDetail= $userDetails;
        $this->attendance =$attendance;
        $this->leave_request=$leaveRequest;
    }
    public function attendanceModule(Request $request){
        
        $userId= $request->session()->get('id');
        $user=$this->user->find($userId);
        $date = Carbon::now();
        $date = $date->format("d-m-Y");
        $attendance= $this->attendance->where(['user_id' => $userId ,'date' => $date])->first();
        return view('/employee/attendance-module',compact('user','attendance'));
    }
    public function attendanceStatus(Request $request)
    { 
        $date = date_create($request->start_date);
        $edate = date_create($request->end_date);
        $diff_date = date_diff($date,$edate);
        $leaveDays = $diff_date->format("%a");
        
        $start_date = date('d-m-Y', strtotime($request->start_date));
        $end_date = date('d-m-Y', strtotime($request->end_date));

      if($request->value == 0){
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required'
        ]);
    }
        $leaveRequest= $request->select;
        if($leaveRequest==2){
            $leaveRequest='Leave';
        }
        else{
            $leaveRequest='Permission';
        }
        $userId= $request->session()->get('id');     
        $user = User::find($userId);
        $date = Carbon::now();
        $date = $date->format("d-m-Y");
         $attendance =   $this->attendance->create([
                    'user_id'=>$userId,
                    'attendance_status'=>$request->value,
                    'leave_status'=>'0',
                    'date'=>$date,
                    'status'=> 1
                  ]);
            $attendance->save(); 
         if($attendance->attendance_status == 0)
         {            
        $leave = $this->leave_request->create([               
                    'leave_type_id'=> '4',
                    'user_id' =>$userId,
                    'description'=>$leaveRequest, 
                    'status'=>'0',
                    'start_date'=>$start_date,
                    'end_date'=>$end_date
                ]);
        $job = new AttendanceDetail($leave,$user);
                    dispatch($job);
        }
        return redirect('/employee/attendance-module');
    }         
    public function leaveRequest($id){
        $user= $this->user->find($id);
        $userId = $user->id;
        $userLd = $this->leave_request->where('user_id',$userId)->first();
        return view('/employee/request-form',compact('user','userLd'));
    }
    public function leaveStatus(Request $request)
    {
          $reason = $request->reason;
          $userId= $request->id;
          LeaveRequest::where('user_id',$userId)
                        ->update([               
                            'leave_type_id'=> $request->leave_type,
                            'status'=>'1',
                        ]);            
              $user= $this->user->find($userId);
              $userRole=$user->role_id;              
              $userTeam=$user->team_id;   
              $teamLeadTeam=$this->userDetail->where('team_id','=',$userTeam)->where('role_id','<', $userRole)->get();
              foreach($teamLeadTeam as $teamLeadTeamId)
               {
                    $teamLead=$teamLeadTeamId->user_id;
               }
            $teamLeadMail = User::find($teamLead);
            $teamLeadMail =$teamLeadMail->email;
   
            $job = new LeavePermissionDetail($teamLeadMail,$user,$reason);
                    dispatch($job);
                    return redirect('/employee/attendance-module');
    }
    public function leaveAccepted($id,$status){
        $user = User::find($id);
        $userId = $user->id;
      if($status==2){
            LeaveRequest::where('user_id',$userId)
                ->where('status','=','1')
                ->update(['status'=> $status,
                         ]);             
      }
    else{
        LeaveRequest::where('user_id',$userId)
                ->where('status','=','1')
                ->update([
                    'leave_type_id'=> 4,
                    'status'=> $status,
                         ]);    
    }
        $job = new LeaveMailSend($status,$user);
                dispatch($job);
    }
}


