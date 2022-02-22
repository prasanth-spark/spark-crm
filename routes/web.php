<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\DarkModeController;
use App\Http\Controllers\admin\EmployeeController;
use App\Http\Controllers\employee\LoginController;
use App\Http\Controllers\employee\AttendanceController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//employee register and login start

Route::group(['prefix'=> 'employee'], function(){
Route::get('register-form',[LoginController::class, 'registerForm'])->name('register-view');
Route::get('user-register/{id}',[LoginController::class, 'registerEmployee'])->name('user-register');
Route::post('user-dashboard',[LoginController::class, 'userDashboard'])->name('user-dashboard');
Route::get('login-form-mail/{id}', [LoginController::class, 'loginFormMail'])->name('login-view-mail');
Route::post('login-employee', [LoginController::class, 'loginEmployee'])->name('employee-login');
Route::get('forgot-password', [LoginController::class, 'forgotPasswordForm'])->name('forgot-view');


// Attendance  

Route::get('attendance-module',[AttendanceController::class, 'attendanceModule'])->name('attendance-module');
Route::get('attendance-status/{status}',[AttendanceController::class,'attendanceStatus'])->name('attendance-status');
Route::get('leave-request/{leave_type}',[AttendanceController::class, 'leaveRequest'])->name('leave-request');
Route::post('attendance-list',[AttendanceController::class, 'attendanceList'])->name('attendance-list');

});

//employee register and login end0
