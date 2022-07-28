<?php

namespace App\Http\Controllers\employee;

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
use Spatie\Permission\Models\Permission;
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
        $this->middleware('permission:attendance-module', ['only' => ['attendanceModule','attendanceStatus']]);
        $this->middleware('permission:leave-response', ['only' => ['leaveResponse','leaveStatus']]);
        $this->middleware('permission:permission-response', ['only' => ['permissionResponse','permissionStatus']]);
        $this->middleware('permission:attendance-show', ['only' => ['attendanceList']]);
    }
    public function attendanceModule(Request $request){

        $userId= auth()->user()->id;
        $user=$this->user->find($userId); 
        $date = Carbon::now();
        $todayDate=$date->format("d-m-Y");
        $date = $date->format("Y-m-d");
        $attendance= $this->attendance->where(['user_id' => $userId ,'date' => $date])->first();
        return view('/employee/attendance-module',compact('user','attendance','todayDate'));
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
        $userId= auth()->user()->id;     
        $user = User::find($userId);
        $userRole=$user->role_id; 

        if($request->attendance_status == 1 && $request->status == 1){
            
            $update = $request->status;
            $date = $request->date;
            $date= date('Y-m-d', strtotime($date));
            if($update == 1){
                Attendance::where(['user_id'=> $userId,'attendance'=>0,'date'=>$date])->update([
                    'attendance'=>1,
                    'attendance_status'=> 1,
                    'status'=>2
                ]);
            }
        }
     else{
        //LEAVE PERMISSION FOR EMPLOYER ,TEAM LEAD AND OTHERS 
    
        if($userRole == 6||$userRole == 7||$userRole == 8){
         if($userRole == 8 || $userRole == 6){
            $tlRole = 1;
            $teamLeadTeam=$this->user->where('role_id','=', $tlRole)->first();
            $teamLead=$teamLeadTeam->id; 
            $teamLeadDetail = User::find($teamLead);
  
        }else{

            $tlRole = $userRole-1;  
            $userTeam=$user->team_id;
            $teamLeadTeam=$this->user->where('team_id','=',$userTeam)->where('role_id','=', $tlRole)->first();
            $teamLead=$teamLeadTeam->id; 
            $teamLeadDetail = User::find($teamLead);
        }
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
                'attendance_status'=>1,
                'in_active'=>$request->inactive_type,
                'status'=> 1
            ]);

            //LEAVE WILL BE ACCEPTED WITHOUT SUPERIORS ACCEPTION IN CASE DEATH REASON 
            
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

            }

            //LEAVE NEED TO BE ACCEPTED  SUPERIORSACCEPTION NOT IN CASE DEATH REASON

            else{
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
          }
        }

        //PERMISSION WILL BE ACCEPTED WITHOUT SUPERIORS ACCEPTION INCASE PERMISSION HOUR IS 1

        else if($attendanceValue == 0 && $leaveRequest=='Permission'){
            $this->attendance->create([
                'user_id'=>$userId,
                'attendance'=>$attendanceValue,
                'date'=>$date,
                'attendance_status'=>1,
                'in_active'=>$request->inactive_type,
                'status'=> 1
            ]);
            if($hourdiff==1){
                $leaveDetail= $this->leave_request->create([               
                    'leave_type_id'=> 1,
                    'permission_type_id'=>$hourdiff,
                    'user_id' =>$userId,
                    'description'=>$reason, 
                    'permission_status'=>1,
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

            }

            //PERMISSION NEED TO BE ACCEPTED WITHOUT SUPERIORS ACCEPTION INCASE PERMISSION HOUR IS NOT 1

            else{
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
        }
    }
    
        //LEAVE AND PERMISSION FOR PROJECT MANAGER AND ARCHITECT  
    else{
        $attendanceValue = $request->status;
        $date = Carbon::now();
        $date = $date->format("Y-m-d");
        $userId= auth()->user()->id;     
        $user = User::find($userId);
        $userRole=$user->role_id; 
        if($userRole == 3||$userRole == 4||$userRole == 5)
        {
            $userTeam=1;
        }
        $teamLeadTeam=$this->user->where('role_id','=',$userTeam)->first();
        $teamLead=$teamLeadTeam->id; 
        $teamLeadDetail = User::find($teamLead);    
        $teamLeadMail =$teamLeadDetail->email;
        $teamLeadName = $teamLeadDetail->name;

        if($attendanceValue == 0 && $leaveRequest=='Permission'){
                $this->attendance->create([
                    'user_id'=>$userId,
                    'attendance'=>$attendanceValue,
                    'date'=>$date,
                    'attendance_status'=>2,
                    'in_active'=>$request->inactive_type,
                    'status'=> 1
                ]);   
            $leaveDetail= $this->leave_request->create([               
                'leave_type_id'=> 1,
                'permission_type_id'=>$hourdiff,
                'user_id' =>$userId,
                'description'=>$reason, 
                'permission_status'=>1,
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


        }
        if($attendanceValue == 0 && $leaveRequest=='Leave'){
            $this->attendance->create([
                'user_id'=>$userId,
                'attendance'=>$attendanceValue,
                'date'=>$date,
                'attendance_status'=>2,
                'in_active'=>$request->inactive_type,
                'status'=> 1
            ]); 
                $leaveDetail= $this->leave_request->create([               
                    'leave_type_id'=> $request->leave_type,
                    'permission_type_id'=>null ,
                    'user_id' =>$userId,
                    'description'=>$reason,
                    'permission_status'=>1, 
                    'leave_status'=>2,
                    'permission_hours_from'=>null,
                    'permission_hours_to'=>null,   
                    'start_date'=>$start_date,
                    'end_date'=>$end_date,
                    'leave_counts'=>$leaveDays,
                    'respond_status'=>0,

                ]);
                $job = new LeaveDetail($teamLeadMail,$teamLeadName,$user,$reason,$leaveDetail);
                dispatch($job); 
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
            }

        }
}
        return redirect('/employee/attendance-module'); 

     }    

                // Leave Response

    public function leaveResponse($tlid,$uid,$lt){
        $teamLead= $this->user->find($tlid);
        $user= User::where('users.id',$uid)
        ->join('leave_requests','leave_requests.user_id','=','users.id')
        ->select('leave_requests.*','users.*')->get();
        return view('/employee/leave_response_form',compact('user','teamLead','lt'));
    }
    public function leaveStatus(Request $request)
    {
        $leaveType = $request->leave_type;
        $reason = $request->rejected_reason;
        $user = User::find($request->user_id);
        $leave_status= $request->leave_response;
        
        if($leave_status == 2){
            Attendance::where('user_id',$user->id)->update([
                'attendance_status'=>3
            ]);
            LeaveRequest::where('user_id',$user->id)->update([
                'leave_status'=>2,
                'respond_status'=>1,
            ]);
            $job = new LeaveMailSend($leave_status,$user,$reason,$leaveType);
                dispatch($job);
        }
        else{
            Attendance::where('user_id',$user->id)->update([
                'attendance_status'=>4
            ]);
            LeaveRequest::where('user_id',$user->id)->update([
                'leave_status'=>3,
                'respond_status'=>1,
            ]);
            $job = new LeaveMailSend($leave_status,$user,$reason,$leaveType);
            dispatch($job);
        }
        return redirect('/employee/employee_dashboard');
    }

        // Permission response

    public function permissionResponse($tlid,$uid,$hourdiff){
            $teamLead= $this->user->find($tlid);
            $user= User::find($uid);
            $hoursdiff =$hourdiff;
            return view('/employee/permission_response_form',compact('user','teamLead','hoursdiff'));
    }

    public function permissionStatus(Request $request)
        {
            $reason = $request->rejected_reason;
            $user = User::find($request->user_id);
            $permission_status= $request->leave_response;
             if($permission_status == 2){
            Attendance::where('user_id',$user->id)->update([
                'attendance_status'=>2
            ]);
            LeaveRequest::where('user_id',$user->id)->update([
                'permission_status'=>1,
                'respond_status'=>1,
            ]);

          }
          else{
            Attendance::where('user_id',$user->id)->update([
                'attendance_status'=>4
            ]);
            LeaveRequest::where('user_id',$user->id)->update([
                'permission_status'=>2,
                'respond_status'=>1,
            ]);
          }
          $job = new PermissionResponse($permission_status,$user,$reason);
                dispatch($job);
        return redirect('/employee/employee_dashboard');
    }

    public function attendanceList(User $user)
    {
        $attendances = $this->attendance->where('user_id',$user->id)->first();
        $date = Carbon::now();
        $date = $date->format("Y-m-d");
        $attendance= $this->attendance->where(['user_id' => $user->id ,'date' => $date])->first();
        $leaveDetails = LeaveRequest::where('user_id',$user->id)->get();
        return view('/employee/attendance-report',compact('user','attendance','leaveDetails'));
    }
    
}

