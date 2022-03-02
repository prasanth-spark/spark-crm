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
        $today_date = Carbon::now(); 
        $today_date = $today_date->format("d-m-Y");
        $date = date_create($request->start_date);
        $edate = date_create($request->end_date);
        $diff_date = date_diff($date,$edate);
        $leaveDay = $diff_date->format("%a"); 
        $leaveDays = $leaveDay +1;

        $start_date = date('d-m-Y', strtotime($request->start_date));
        $end_date = date('d-m-Y', strtotime($request->end_date));   

        if($request->attendance_registered_user == 1){
            $regUserId = $request->registered_user_id;
            $in_active_id = $request->select;
            $user = user::find($regUserId);
             if($in_active_id=='1'){
                Attendance::where('user_id',$regUserId)->update([
                    'attendance'=>$request->value,
                    'attendance_status'=> $request->value,
                    'in_active'=>$in_active_id
                 ]);
                 $in_active_id = 'Permission';
                 $leave = $this->leave_request->create([               
                    'leave_type_id'=> 1,
                    'permission_type_id'=>$request->permission,
                    'user_id' =>$regUserId,
                    'description'=>$in_active_id, 
                    'leave_status'=>0,
                    'permission_hours_from'=>$request->permission_hours_from,
                    'permission_hours_to'=>$request->permission_hours_to,
                    'start_date'=>$today_date,
                    'end_date'=>$today_date,
                    'leave_counts'=>null,
                ]);
                $job = new AttendanceDetail($leave,$user);
                    dispatch($job);
             }
             else if($in_active_id=='2')
             { 
                Attendance::where('user_id',$regUserId)->update([
                    'attendance'=>$request->value,
                    'attendance_status'=> $request->value,
                    'in_active'=>2
                 ]);
                 $in_active_id = 'Leave';
                $leave = $this->leave_request->create([               
                    'leave_type_id'=> 4,
                    'permission_type_id'=>null ,
                    'user_id' =>$regUserId,
                    'description'=>$in_active_id, 
                    'leave_status'=>0,
                    'permission_hours_from'=>null,
                    'permission_hours_to'=>null,   
                    'start_date'=>$start_date,
                    'end_date'=>$end_date,
                    'leave_counts'=>$leaveDays,
                ]);
                $job = new AttendanceDetail($leave,$user);
                    dispatch($job);   
             }
             else{
                Attendance::where('user_id',$regUserId)->update([
                    'attendance'=>$request->value,
                    'attendance_status'=> $request->value,
                 ]);
                
                return back();   
            }
        }
      if($request->value == 0 && $request->select==2){
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required'
        ]);
    }
        $leaveRequest= $request->inactive_value;
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
        $attendanceValue = $request->value;
        if($attendanceValue == 0 && $leaveRequest=='Leave'){
                $attendance =   $this->attendance->create([
                    'user_id'=>$userId,
                    'attendance'=>$attendanceValue,
                    'date'=>$date,
                    'attendance_status'=>2,
                    'in_active'=>$request->select,
                    'status'=> 1
                ]);
                $leave = $this->leave_request->create([               
                    'leave_type_id'=> 4,
                    'permission_type_id'=>null ,
                    'user_id' =>$userId,
                    'description'=>$leaveRequest, 
                    'leave_status'=>0,
                    'permission_hours_from'=>null,
                    'permission_hours_to'=>null,   
                    'start_date'=>$start_date,
                    'end_date'=>$end_date,
                    'leave_counts'=>$leaveDays,
                ]);
                $job = new AttendanceDetail($leave,$user);
                    dispatch($job);   
                
        }
        else if($attendanceValue == 0 && $leaveRequest=='Permission'){
            $attendance =   $this->attendance->create([
                'user_id'=>$userId,
                'attendance'=>$attendanceValue,
                'date'=>$date,
                'attendance_status'=>2,
                'in_active'=>$request->select,
                'status'=> 1
            ]);
           
            $leave = $this->leave_request->create([               
                'leave_type_id'=> 1,
                'permission_type_id'=>$request->permission,
                'user_id' =>$userId,
                'description'=>$leaveRequest, 
                'leave_status'=>0,
                'permission_hours_from'=>$request->permission_hours_from,
                'permission_hours_to'=>$request->permission_hours_to,
                'start_date'=>$today_date,
                'end_date'=>$today_date,
                'leave_counts'=>null,
            ]);
            $job = new AttendanceDetail($leave,$user);
                dispatch($job);
        }
        else{
            $attendance =   $this->attendance->create([
                'user_id'=>$userId,
                'attendance'=>$attendanceValue,
                'date'=>$date,
                'attendance_status'=>1,
                'in_active'=>null,
                'status'=> 1
            ]);
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
                            'leave_status'=>1,
                        ]);          
              $user= $this->user->find($userId);
              $userRole=$user->role_id; 
              $tlRole = $userRole-1;     
              $userTeam=$user->team_id; 
              $teamLeadTeam=$this->userDetail->where('team_id','=',$userTeam)->where('role_id','=', $tlRole)->first();
              $teamLead=$teamLeadTeam->user_id;  
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
                ->where('leave_status','=',1)
                ->update(['leave_status'=> $status,
                         ]);                                        
      }
    else{
        LeaveRequest::where('user_id',$userId)
                ->where('leave_status','=',1)
                ->update([
                    'leave_type_id'=> 4,
                    'leave_status'=> $status,
                         ]);   
            Attendance::where('user_id',$userId)->update([
                        'attendance_status'=>0,
          ]);       
    }
        $job = new LeaveMailSend($status,$user);
                dispatch($job);
                return redirect('/employee/employee_dashboard');
    }

    public function attendanceList($id){
        $user = User::find($id);
        // $attendance = Attendance::where('user_id',$user->id)->first();
        // $leaveDetails = LeaveRequest::where('user_id',$user->id)->first();

        return view('/employee/attendance-report',compact('user'));
    }
    
}

