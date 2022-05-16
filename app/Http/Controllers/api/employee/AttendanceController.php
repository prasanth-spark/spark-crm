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
     
}
