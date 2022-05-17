<?php

namespace App\Http\Controllers\api\employee;

use App\Http\Controllers\Controller;
use App\Jobs\PermissionDetail;
use App\Jobs\LeaveDetail;
use App\Jobs\LeaveMailSend;
use App\Jobs\PermissionResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\LeaveRequest;
use App\Models\Attendance;
use App\Models\Permission;
use App\Models\RoleModel;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function __construct(User $user,UserDetails $userDetails,Attendance $attendance,LeaveRequest $leaveRequest)
    {
        $this->user =$user;
        $this->userDetail= $userDetails;
        $this->attendance =$attendance;
        $this->leave_request=$leaveRequest;

        //$this->middleware(['role:Employee|Team Leader|Project Manager']);
    }
        public function attendanceStatus(Request $request)
        {  
            if($request->status == 0){
                $request->validate([
                    'reason' => 'required',
                ]);
            }
            if($request->inactive_type==1 && $request->status == 0){
                $request->validate([
                    'permission_hours_from' => 'required|date_format:H:i',
                    'permission_hours_to' => 'required|date_format:H:i|after:permission_hours_from',
    
                ]);
            }
           
            if($request->inactive_type==2 && $request->status == 0){
                $request->validate([
                    'start_date' => 'after:yesterday',
                    'end_date' => 'after_or_equal:start_date',
            ]);
        
            }
           // permission hours
            $time1 = $request->permission_hours_to;  
            $time1 = strtotime($time1);
            $time2 = $request->permission_hours_from;
            $time2 = strtotime($time2);
            $diff = ($time1-$time2)/3600;
            $hourdiff = (int)(round($diff));
    
    
    
            // Leave days
            $start_date = date('Y-m-d', strtotime($request->leave_days_from));
            $end_date = date('Y-m-d', strtotime($request->leave_days_to)); 
            $today_date = Carbon::now(); 
            $today_date = $today_date->format("Y-m-d");
            $date = date_create($request->leave_days_from);
            $edate = date_create($request->leave_days_to);
            $diff_date = date_diff($date,$edate);
            $leaveDay = $diff_date->format("%a");
            $leaveDays = $leaveDay +1;
    
            $start_date = date('Y-m-d', strtotime($request->leave_days_from));
            $end_date = date('Y-m-d', strtotime($request->leave_days_to)); 
    
            $leaveRequest= $request->inactive_type;
              if($leaveRequest==2){
                    $leaveRequest='Leave';
                }
              else{
                    $leaveRequest='Permission';
                }
            $reason = $request->reason;
            $userId= $request->user_id;  
            $user = User::find($userId);
            $userRole=$user->role_id; 
            $tlRole = $userRole-1;  
            $userTeam=$user->team_id;
            $teamLeadTeam=$this->userDetail->where('team_id','=',$userTeam)->where('role_id','=', $tlRole)->first();
            $teamLead=$teamLeadTeam->user_id; 
            $teamLeadDetail = User::find($teamLead);
            $teamLeadMail =$teamLeadDetail->email;
            $teamLeadName = $teamLeadDetail->name;
            $attendanceValue = $request->status;
            $date = Carbon::now();
            $date = $date->format("Y-m-d");
    
            if($attendanceValue == 0 && $leaveRequest=='Leave'){
                $this->attendance->create([
                    'user_id'=>$userId,
                    'attendance'=>$attendanceValue,
                    'date'=>$date,
                    'attendance_status'=>2,
                    'in_active'=>$request->inactive_type,
                    'status'=> 1
                ]); 
                if($request->leave_type==5){
                    $leaveDetail= $this->leave_request->create([               
                        'leave_type_id'=> $request->leave_type,
                        'permission_type_id'=>null ,
                        'user_id' =>$userId,
                        'description'=>$reason,
                        'permission_status'=>null, 
                        'leave_status'=>2,
                        'permission_hours_from'=>null,
                        'permission_hours_to'=>null,   
                        'start_date'=>$start_date,
                        'end_date'=>$end_date,
                        'leave_counts'=>$leaveDays,
                        'respond_status'=>1,
                    ]);
                    $job = new LeaveDetail($teamLeadMail,$teamLeadName,$user,$reason,$leaveDetail);
                    dispatch($job);
                    $leave_status = "2";
                    $leaveType =$request->leave_type;
                    $jobs = new LeaveMailSend($leave_status,$user,$reason,$leaveType);
                    dispatch($jobs);
                    return response()->json(['status'=>true,'message'=>'Your Leave Permission send to TeamLead']);

                }else{
                    if($request->leave_days_from !=null && $request->leave_days_to != null)
                    {
                    $leaveDetail= $this->leave_request->create([               
                    'leave_type_id'=> $request->leave_type,
                    'permission_type_id'=>null ,
                    'user_id' =>$userId,
                    'description'=>$reason,
                    'permission_status'=>null, 
                    'leave_status'=>1,
                    'permission_hours_from'=>null,
                    'permission_hours_to'=>null,   
                    'start_date'=>$start_date,
                    'end_date'=>$end_date,
                    'leave_counts'=>$leaveDays,
                    'respond_status'=>0,
                ]);
                $job = new LeaveDetail($teamLeadMail,$teamLeadName,$user,$reason,$leaveDetail);
                  dispatch($job);
                  return response()->json(['status'=>true,'message'=>'Leave Permission Request send to Your TeamLead.Pls wait for Approvel']);
              }else{
                return response()->json(['status'=>true,'message'=>'Pls enter Valid date']);
              }
            }
            }
            else if($attendanceValue == 0 && $leaveRequest=='Permission'){
                $this->attendance->create([
                    'user_id'=>$userId,
                    'attendance'=>$attendanceValue,
                    'date'=>$date,
                    'attendance_status'=>2,
                    'in_active'=>$request->inactive_type,
                    'status'=> 1
                ]);
                if($hourdiff==1){
                    $leaveDetail= $this->leave_request->create([               
                        'leave_type_id'=> 1,
                        'permission_type_id'=>$hourdiff,
                        'user_id' =>$userId,
                        'description'=>$reason, 
                        'permission_status'=>2,
                        'leave_status'=>null,
                        'permission_hours_from'=>$request->permission_hours_from,
                        'permission_hours_to'=>$request->permission_hours_to,
                        'start_date'=>$today_date,
                        'end_date'=>$today_date,
                        'leave_counts'=>null,
                        'respond_status'=>1,
                    ]);
                    $job = new PermissionDetail($teamLeadMail,$teamLeadName,$user,$reason,$leaveDetail);
                          dispatch($job);
                     $permission_status= 2;
                     $job = new PermissionResponse($permission_status,$user,$reason);
                    dispatch($job);
                    return response()->json(['status'=>true,'message'=>'Your Permission Request Send to Your TeamLead']);

                }else{
                $leaveDetail= $this->leave_request->create([               
                    'leave_type_id'=> 1,
                    'permission_type_id'=>$hourdiff,
                    'user_id' =>$userId,
                    'description'=>$reason, 
                    'permission_status'=>0,
                    'leave_status'=>null,
                    'permission_hours_from'=>$request->permission_hours_from,
                    'permission_hours_to'=>$request->permission_hours_to,
                    'start_date'=>$today_date,
                    'end_date'=>$today_date,
                    'leave_counts'=>null,
                    'respond_status'=>0,
                ]);
                $job = new PermissionDetail($teamLeadMail,$teamLeadName,$user,$reason,$leaveDetail);
                      dispatch($job);
                      return response()->json(['status'=>true,'message'=>'Your Permission Request Send to TeamLead']);
               }
            }
            else{
                $this->attendance->create([
                    'user_id'=>$userId,
                    'attendance'=>1,
                    'date'=>$date,
                    'attendance_status'=>1,
                    'in_active'=>null,
                    'status'=> 1
                ]);
                return response()->json(['status'=>true,'message'=>'User Active Successfull']);

            }
    
        }    


     
}
