<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PermissionController extends Controller
{
    public function __construct(Attendance $attendance)
    {
        $this->attendance   = $attendance;
        $this->middleware('permission:permission-detail', ['only' => ['permissionDetail']]);
        $this->middleware('permission:permission-approvel', ['only' => ['permissionApprovel']]);
        $this->middleware('permission:permission-deny', ['only' => ['permissionDeny']]);
    }
    public function permissionDetail()
    {
        $PermissionLists = LeaveRequest::where('respond_status', '=', 0)->with('leaverequestUser','leaverequestUser.roleToUser','leaverequestUser.teamToUser','permissionType')->latest()->get();
        return view('employee/permission-detail', compact('PermissionLists'));
    }
    public function permissionApprovel(Request $request)
    {   
      $date = Carbon::now();
      $date = $date->format("Y-m-d");
      if($request->type==1){
        $data =  array(
          'user_id' =>$request->user_id,
          'attendance_status'=>1,
          'date' => $date
        );
        $verify =  Attendance::where([
          ['user_id','=',$request->user_id],
          ['attendance_status','=',1],
          ['attendance','=',0],
          ['date','=',$date]
          ]);
        $verifyUser = $verify->first();
        if(isset($verifyUser)){
          $verifyUser->update(['attendance_status' => 1]);
          }else{
            Attendance::create($data);
          }
          LeaveRequest::where([
          ['id',$request->id],['user_id',$request->user_id]
          ])->update([
            'permission_status'=>1,
            'respond_status'=>1,
        ]);
    
      }else{
        $data =  array(
          'user_id' =>$request->user_id,
          'attendance_status'=>1,
          'in_active'=>2,
          'date' => $date
        );
        $verify =  Attendance::where([
          ['user_id','=',$request->user_id],
          ['attendance_status','=',1],
          ['attendance','=',0],
          ['in_active','=',2],
          ['date','=',$date]
          ]);
        $verifyUser = $verify->first();
        if(isset($verifyUser)){
          $verifyUser->update(['attendance_status' => 2]);
          }else{
            Attendance::create($data);
          }
        LeaveRequest::where([
          ['id',$request->id],['user_id',$request->user_id]
          ])->update([
            'leave_status'=>2,
            'respond_status'=>1,
        ]);
    
     }
    }

    public function permissionDeny(Request $request)
    {   
      $date = Carbon::now();
      $date = $date->format("Y-m-d");
      if($request->type==1){
        $data =  array(
          'user_id' =>$request->user_id,
          'attendance_status'=>4,
          'date' => $date
        );
        $verify =  Attendance::where([
          ['user_id','=',$request->user_id],
          ['attendance_status','=',1],
          ['attendance','=',0],
          ['date','=',$date]
          ]);
        $verifyUser = $verify->first();
        if(isset($verifyUser)){
          $verifyUser->update(['attendance_status' => 4]);
          }else{
            Attendance::create($data);
          }
          LeaveRequest::where([
            ['id',$request->id],['user_id',$request->user_id]
            ])->update([
        'permission_status'=>2,
        'respond_status'=>1,
        ]);
    
    }else{
      $data =  array(
        'user_id' =>$request->user_id,
        'attendance_status'=>4,
        'date' => $date
      );
      $verify =  Attendance::where([
        ['user_id','=',$request->user_id],
        ['attendance_status','=',1],
        ['attendance','=',0],
        ['in_active','=',2],
        ['date','=',$date]
        ]);

      $verifyUser = $verify->first();

      if(isset($verifyUser)){
        $verifyUser->update(['attendance_status' => 4]);
        }else{
          Attendance::create($data);
        }
        LeaveRequest::where([
          ['id',$request->id],['user_id',$request->user_id]
          ])->update([
      'leave_status'=>3,
      'respond_status'=>1,
    ]);
    }
  } 

}
