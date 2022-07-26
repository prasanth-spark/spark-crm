<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;

class PermissionController extends Controller
{
    public function __construct(Attendance $attendance)
    {
        $this->attendance   = $attendance;

    }
    public function permissionDetail()
    {
        return view('employee/permission-details');
    }

}
