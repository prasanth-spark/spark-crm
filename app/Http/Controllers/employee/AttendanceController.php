<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AttendanceController extends Controller
{
    public function attendanceModule(){
 
        return view('/employee/attendance-module');
    }
}