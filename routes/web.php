<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\employee\LoginController;
use App\Http\Controllers\employee\AttendanceController;
use App\Http\Controllers\employee\TaskController;
use App\Http\Controllers\employee\UserProfileController;




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


    Route::middleware('userloggedin_auth')->group(function() {    

            //employee register and login start
            Route::get('register-form',[LoginController::class, 'registerForm'])->name('register-view');
            Route::get('user-register/{id}',[LoginController::class, 'registerEmployee'])->name('user-register');
            Route::post('user-dashboard',[LoginController::class, 'userDashboard'])->name('user-dashboard');
            Route::get('login-form-mail/{id}', [LoginController::class, 'loginFormMail'])->name('login-view-mail');
            Route::post('login-employee', [LoginController::class, 'loginEmployee'])->name('employee-login');
            Route::get('forgot-password', [LoginController::class, 'forgotPasswordForm'])->name('forgot-view');
            Route::get('login-form',[LoginController::class, 'loginForm'])->name('user-login-view');
            Route::post('forgot-form-verify', [LoginController::class, 'forgotFormVerify'])->name('forgot-form-verify');
            Route::get('reset-password-view/{id}', [LoginController::class, 'resetPasswordView'])->name('reset-password-view');
            Route::post('reset-password', [LoginController::class, 'resetPassword'])->name('reset-password');
             

    });
  

    Route::middleware('employee_auth')->group(function() {
            Route::get('/employee_dashboard',[LoginController::class, 'employeeDashboard'])->name('employee-dashboard');
            Route::get('logout-employee', [LoginController::class, 'logout'])->name('employee-logout');

            //task sheet form
            Route::get('/task-form', [TaskController::class, 'taskForm'])->name('task-form');
            Route::post('/task-add', [TaskController::class, 'taskAdd'])->name('task-add');
            Route::get('/task-list',[TaskController::class,'taskList'])->name('task-list');
            Route::get('/task-details/{id}', [TaskController::class, 'taskDetails'])->name('task-details');
            Route::get('/task-edit/{id}', [TaskController::class, 'taskEdit'])->name('task-edit');
            Route::post('/task-update', [TaskController::class, 'taskUpdate'])->name('task-update');

          // Attendance  
            Route::get('attendance-module',[AttendanceController::class, 'attendanceModule'])->name('attendance-module');
            Route::Post('attendance-status',[AttendanceController::class,'attendanceStatus'])->name('attendance-status');
            Route::get('leave-request/{id}',[AttendanceController::class, 'leaveRequest'])->name('leave-request');
            Route::post('leave-status',[AttendanceController::class, 'leaveStatus'])->name('leave-status');
            Route::get('leave-accepted/{id}/{status}',[AttendanceController::class, 'leaveAccepted'])->name('leave-accepted');
            Route::post('attendance-list',[AttendanceController::class, 'attendanceList'])->name('attendance-list');


            //User Profile
            Route::get('user-profile-form',[UserProfileController::class, 'userProfileForm'])->name('user-profile-form');
            Route::post('user-profile-add',[UserProfileController::class, 'userProfileAdd'])->name('user-profile-add');
              
    });
