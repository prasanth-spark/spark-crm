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
        $date = $date->format("Y-m-d");
        $attendance= $this->attendance->where(['user_id' => $userId ,'date' => $date])->first(); 
        return view('/employee/attendance-module',compact('user','attendance'));
    }
    public function attendanceStatus(Request $request)
    {  
        // dd($request->all());
        if($request->value == 0){
            $request->validate([
                'reason' => 'required',
            ]);
        }
        if($request->inactive_type==1 && $request->value == 0){
            $request->validate([
                'permission_hours_from' => 'required|date_format:H:i',
                'permission_hours_to' => 'required|date_format:H:i|after:permission_hours_from',

            ]);
        }
       if($request->inactive_type==2 && $request->value == 0){
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
        $userId= $request->session()->get('id');     
        $user = User::find($userId);
        $userRole=$user->role_id; 
        $tlRole = $userRole-1;   
        $userTeam=$user->team_id;
        $teamLeadTeam=$this->userDetail->where('team_id','=',$userTeam)->where('role_id','=', $tlRole)->first();
        $teamLead=$teamLeadTeam->user_id; 
        $teamLeadDetail = User::find($teamLead);
        $teamLeadMail =$teamLeadDetail->email;
        $teamLeadName = $teamLeadDetail->name;
        $attendanceValue = $request->value;
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

            }else{
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
        return redirect('/employee/attendance-module'); 
     }    

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

        // permission response

        public function permissionResponse($tlid,$uid,$hourdiff){

            $teamLead= $this->user->find($tlid);
            $user= User::find($uid);
            $hoursdiff =$hourdiff;
            return view('/employee/permission_response_form',compact('user','teamLead','hoursdiff'));
        }
        public function permissionStatus(Request $request)
        {
            // dd($request->all());
            $reason = $request->rejected_reason;
            $user = User::find($request->user_id);
            $permission_status= $request->leave_response;
             if($permission_status == 2){
            Attendance::where('user_id',$user->id)->update([
                'attendance_status'=>2
            ]);
            LeaveRequest::where('user_id',$user->id)->update([
                'permission_status'=>1,
                'respond_status'=>1
            ]);
          }
          else{
            Attendance::where('user_id',$user->id)->update([
                'attendance_status'=>4
            ]);
            LeaveRequest::where('user_id',$user->id)->update([
                'permission_status'=>2,
                'respond_status'=>1
            ]);
          }
          $job = new PermissionResponse($permission_status,$user,$reason);
                dispatch($job);
        return redirect('/employee/employee_dashboard');
        }


    //  public function leaveAccepted($id,$status){ 
    //       $user = User::find($id);
    //       $userId = $user->id;
    //       if($status==3){
    //         LeaveRequest::where('user_id',$userId)
    //           ->where('leave_status',1)
    //           ->update([
    //                     'leave_status'=> $status,
    //                     'mail_status'=>2,
    //                      ]);
    //         Attendance::where('user_id',$userId)->update([
    //                     'attendance_status'=>4,
    //                 ]);        
    //     }
    //     else{
    //         LeaveRequest::where('user_id',$userId)
    //         ->where('leave_status',1)
    //         ->update([
    //                   'leave_status'=> $status,
    //                   'mail_status'=>2,
    //                    ]);
    //       Attendance::where('user_id',$userId)->update([
    //                   'attendance_status'=>3,
    //               ]);  
    //     }   
    // }












// public function leaveRequest($id){
//     $user= $this->user->find($id);
//     $userId = $user->id;
//     $date=Carbon::now();
//     $date = $date->format("Y-m-d");
//     $userLd = $this->leave_request->where(['user_id' => $userId ,'start_date' => $date])->first();
//     return view('/employee/request-form',compact('user','userLd'));
// }
//     public function leaveStatus(Request $request)
//     {
//           $reason = $request->reason;
//           $userId= $request->id;
//           LeaveRequest::where('user_id',$userId)->where('leave_status',0)
//                         ->update([               
//                             'leave_type_id'=> $request->leave_type,
//                             'leave_status'=>1,
//              ]);   
           
//               $user= $this->user->find($userId);
//               $userRole=$user->role_id; 
//               $tlRole = $userRole-1;     
//               $userTeam=$user->team_id;
//               $teamLeadTeam=$this->userDetail->where('team_id','=',$userTeam)->where('role_id','=', $tlRole)->first();
//               $teamLead=$teamLeadTeam->user_id; 
//               $teamLeadMail = User::find($teamLead);
//               $teamLeadMail =$teamLeadMail->email;
//           $job = new LeavePermissionDetail($teamLeadMail,$user,$reason);
//                     dispatch($job);
//                     return redirect('/employee/attendance-module');
//     }
//     public function leaveAccepted($id,$status){ 
//         $user = User::find($id);
//         $userId = $user->id;
//       if($status==2){
//             LeaveRequest::where('user_id',$userId)
//                 ->where('leave_status',1)->where('leave_type_id',1)
//                 ->update(['// public function leaveRequest($id){
//     $user= $this->user->find($id);
//     $userId = $user->id;
//     $date=Carbon::now();
//     $date = $date->format("Y-m-d");
//     $userLd = $this->leave_request->where(['user_id' => $userId ,'start_date' => $date])->first();
//     return view('/employee/request-form',compact('user','userLd'));
// }   permission_status'=> 1,
//                          ]);           
//            Attendance::where('user_id',$userId)->update([
//                     'attendance_status'=>3,
//               ]);
//       }
//     else{
//         LeaveRequest::where('user_id',$userId)
//                 ->where('leave_status',1)->where('leave_type_id',1)
//                 ->update([
//                     'permission_status'=> 2,
//                          ]);               
//         LeaveRequest::where('user_id',$userId)->where('leave_type_id','!=',1)
//                 ->where('leave_status','=',1)
//                 ->update([
//                     'leave_type_id'=> 4,
//                     'leave_status'=> $status,
//                          ]);   
//             Attendance::where('user_id',$userId)->update([
//                         'attendance_status'=>4,
//           ]);       
//     }
//         $job = new LeaveMailSend($status,$user);
//                 dispatch($job);
//                 return redirect('/employee/employee_dashboard');
//     }
    public function attendanceList($id){
        $user = User::find($id);
        $date = Carbon::now();
        $date = $date->format("Y-m-d");
        $attendance= $this->attendance->where(['user_id' => $user->id ,'date' => $date])->first();
        $leaveDetails = LeaveRequest::where('user_id',$user->id)->get();
        return view('/employee/attendance-report',compact('user','attendance','leaveDetails'));
}
    
}

