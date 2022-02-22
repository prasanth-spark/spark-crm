<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Jobs\AttendanceDetail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;


class AttendanceController extends Controller
{ 
    public function __construct(User $user,Attendance $attendance)
    {
        $this->user =$user;
        $this->attendance =$attendance;
    }
    

    public function attendanceModule(Request $request){
        $userId= $request->session()->get('user_id');
        $user=$this->user->where('id',$userId)->first();
        return view('/employee/attendance-module',compact('user'));
    }
    public function attendanceStatus(Request $request,$status)
    {
        dd($status);
        $userId= $request->session()->get('user_id');
        $this->attendance->create([
            'user_id'=>$userId,
            'attendance_status'=>$status,
            'leave_status'=>'0',
            'status'=>'1'
        ]);
        return redirect('/attendance-module');
    }
    public function leaveRequest(Request $request,$leave_type){
        dd($leave_type);
        // $status = $this->attendance->where('status','=','0')->first();
            $status=0;
            $userId= $request->session()->get('user_id');
            $userDetail=User::where('id',$userId)->first();
            // dd($userDetail);
            // $id =$userDetail->id;
            dd($userDetail);
            $job = new AttendanceDetail($leave_type,$userDetail,$status);
            dispatch($job);
        }
}