<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    public function permissionDetail()
    {
        $PermissionLists = LeaveRequest::where('respond_status', '=', 0)->with('leaverequestUser', 'leaverequestUser.roleToUser','leaverequestUser.teamToUser','permissionType')->latest()->get();
        return view('admin/employee/permission-detail', compact('PermissionLists'));
    }

    public function permissionApprovel($id,$leave_type_id)
    {   
      if($leave_type_id == 1){
            Attendance::where('user_id',$id)->update([
                'attendance_status'=>2
            ]);
            LeaveRequest::where('user_id',$id)->update([
                'permission_status'=>1,
                'respond_status'=>1,
            ]);
        return redirect()->back();
        }else{
            Attendance::where('user_id',$id)->update([
              'attendance_status'=>3
            ]);
            LeaveRequest::where('user_id',$id)->update([
              'leave_status'=>2,
              'respond_status'=>1,
              ]);
         return redirect()->back();
         }
    }
    public function permissionDeny($id,$leave_type_id)
    {   
        if($leave_type_id == 1){
              Attendance::where('user_id',$id)->update([
                'attendance_status'=>4
              ]);
              LeaveRequest::where('user_id',$id)->update([
                'permission_status'=>2,
                'respond_status'=>1,
              ]);   
         return redirect()->back();
         }else{
              Attendance::where('user_id',$id)->update([
              'attendance_status'=>4
              ]);
              LeaveRequest::where('user_id',$id)->update([
              'leave_status'=>3,
              'respond_status'=>1,
              ]);
         return redirect()->back();
        }
    } 

}
