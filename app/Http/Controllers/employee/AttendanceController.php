<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Jobs\AttendanceDetail;
use App\Jobs\LeavePermissionDetail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\LeaveRequest;
use App\Models\Attendance;


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
        
        $userId= $request->session()->get('employee');
        $user=$this->user->find($userId);
        // dd($user);
        return view('/employee/attendance-module',compact('user'));
    }
    public function attendanceStatus(Request $request)
    {
        dd($request->all());
            $leaveRequest= $request->select;
            if($leaveRequest==2){
                $leaveRequest='Leave';
            }
            else{
                $leaveRequest='Permission';
            }
        $userId= $request->session()->get('employee');
        // dd($userId);
        $user = User::find($userId);
         $attendance =   $this->attendance->create([
                    'user_id'=>$userId,
                    'attendance_status'=>$request->value,
                    'leave_status'=>'0',
                    'date'=>$request->today_date,
                    'status'=>'1'
                  ]);
            $attendance->save(); 
         if($attendance->attendance_status == 0)
         {            
        $leave = $this->leave_request->create([               
                    'leave_type_id'=> '4',
                    'user_id' =>$userId,
                    'description'=>$leaveRequest, 
                    'status'=>'0',
                    'start_date'=>$request->start_date,
                    'end_date'=>$request->end_date
                ]);
        $leave->save();
        $job = new AttendanceDetail($leave,$user);
                    dispatch($job);
        }
        return redirect('/employee/attendance-module');
    }         
    public function leaveRequest($id){
        $user= $this->user->find($id);
        return view('/employee/request-form',compact('user'));
    }
    public function leaveStatus(Request $request){
          $reason = $request->reason;
          $userId= $request->id;

            $leaveRequest = LeaveRequest::where('user_id',$userId)
                        ->where('start_date','=',$request->start_date)
                        ->where('end_date','=',$request->end_date)
                        ->update([               
                            'leave_type_id'=> $request->leave_type,
                            'status'=>'1',
                        ]);
            //  dd($leaveRequest);
              $user= $this->user->find($userId);
              $userTeam=$user->team_id;
              $teams = $this->userDetail->where('team_id',$userTeam)->get();
              foreach($teams as $team){
                $role=$team->pluck('role_id');
              } 
              $teamLeadTeam=$this->userDetail->where('team_id','=',$userTeam)->where('role_id','<',$role)->get();
              foreach($teamLeadTeam as $teamLeadTeamId)
               {
                    $teamLead=$teamLeadTeamId->user_id;
               }
            $teamLeadMail = User::find($teamLead);
            $teamLeadMail =$teamLeadMail->email;
            // dd($teamLeadMail);
            $job = new LeavePermissionDetail($teamLeadMail,$user,$reason);
                    dispatch($job);

    }
    public function leaveAccepted($id,$status){
        // dd($status);
      if($status==2){
            LeaveRequest::where('user_id',$id)
                ->where('status','=','1')
                ->update(['status'=> $status,
                         ]);             
      }
    else{
        LeaveRequest::where('user_id',$id)
                ->where('status','=','1')
                ->update(['status'=> $status,
                         ]);    

    }


    }
}









// cron->daily->status
            // $user = User::where('status','!=',0)->pluck('id');
            // $attendance = DB::table('attendance')->pluck('user_id');
            // $attendanceNotUpdatedUser = array_diff($user,$attendance);
// job->1st leave mail
        //  $a=$leave->description;    
        //   if($a=='permission'){   
        //   $email = new PermissionMail($user);
        //   Mail::to($user->email)->send($email);
        // }
        // else{
        // $email =new LeaveMail($user);
        // Mail::to($user->email)->send($email);   
        // }

//  teamlead
            // $user= $this->user->where('id',$userId)->with('userTeamId')->pluck('team_id');
            // $team = $this->userDetail->where('team_id',$user)->get();
            // foreach($userTeam as $team){
            //     $lead = $team->role_id;
            // $role=$team->pluck('role_id'); 
            // $teamlead=$this->userDetail->where('team_id','=',$user)->where('role_id','<',$role)->get();
            //foreach($teamLeadTeam as $teamLeadTeamId){
            //     $teamLead=$teamLeadTeamId->user_id;
            //    }


