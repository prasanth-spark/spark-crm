<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\employee\LoginController;
use App\Http\Controllers\employee\AttendanceController;
use App\Http\Controllers\employee\TaskController;
use App\Http\Controllers\employee\UserProfileController;
use App\Http\Controllers\employee\TeamTaskController;
use App\Http\Controllers\employee\TeamAttendanceController;
use App\Http\Controllers\employee\ProjectAssignController;
use App\Http\Controllers\employee\EmployeeController;
use App\Http\Controllers\employee\PermissionController;




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
            Route::get('/task-details/{taskView}', [TaskController::class, 'taskDetails'])->name('task-details');
            Route::get('/task-edit/{taskEdit}', [TaskController::class, 'taskEdit'])->name('task-edit');
            Route::post('/task-update', [TaskController::class, 'taskUpdate'])->name('task-update');
            Route::get('/task-pagination',[TaskController::class, 'taskPagination'])->name('task-pagination');

          // Attendance  
            Route::get('attendance-module',[AttendanceController::class, 'attendanceModule'])->name('attendance-module');
            Route::post('attendance-status',[AttendanceController::class,'attendanceStatus'])->name('attendance-status');
            Route::get('leave-response/{tlid}/{uid}/{lt}',[AttendanceController::class, 'leaveResponse'])->name('leave-response');
            Route::post('leave-status',[AttendanceController::class, 'leaveStatus'])->name('leave-status');
            Route::get('permission-response/{tlid}/{uid}/{hourdiff}',[AttendanceController::class, 'permissionResponse'])->name('permission-response');
            Route::post('permission-status',[AttendanceController::class, 'permissionStatus'])->name('permission-status');
            Route::get('leave-accepted/{id}/{status}',[AttendanceController::class, 'leaveAccepted'])->name('leave-accepted');
            Route::get('attendance-show/{user}',[AttendanceController::class, 'attendanceList'])->name('attendance-show');


            //User Profile
            Route::get('user-profile-form',[UserProfileController::class, 'userProfileForm'])->name('user-profile-form');
            Route::post('user-profile-add',[UserProfileController::class, 'userProfileAdd'])->name('user-profile-add');
            Route::get('user-reset-form',[UserProfileController::class, 'userResetForm'])->name('user-reset-password');
            Route::post('user-change-password',[UserProfileController::class, 'userChangePassword'])->name('user-change-password');
            Route::post('user-language-add',[UserProfileController::class, 'languageSkillAdd'])->name('user-language-add');




            //Team Task
            Route::get('team-task',[TeamTaskController::class, 'teamTask'])->name('team-task');

            //Team Attendance
            Route::get('team-attentance',[TeamAttendanceController::class, 'teamAttendanceList'])->name('attendance');

            //Team Absent
            Route::get('team-absent',[TeamAttendanceController::class, 'teamAbsentList'])->name('team-absent');

            //Team Permission
            Route::get('team-permission',[TeamAttendanceController::class, 'teamPermissionlist'])->name('team-permission');

            //Add project
            Route::get('project-list',[ProjectAssignController::class,'ProjectList'])->name('project-list');
            Route::get('project-form',[ProjectAssignController::class, 'ProjectForm'])->name('project-form');
            Route::post('add-project-form',[ProjectAssignController::class, 'addProject'])->name('add-project-form');
            Route::get('edit-project/{project}',[ProjectAssignController::class, 'editProject'])->name('edit-project');
            Route::post('update-project/{project}',[ProjectAssignController::class, 'updateProject'])->name('update-project');
            Route::Post('delete-project/{project}',[ProjectAssignController::class, 'deleteProject'])->name('delete-project');
           
           
            Route::get('/employeelist', [EmployeeController::class, 'employeeList'])->name('employeelist');
            Route::get('/employee-pagination', [EmployeeController::class, 'employeeListPagination'])->name('employee-pagination');
            Route::get('/employeeform', [EmployeeController::class, 'employeeForm'])->name('employeeform');
            Route::post('/employeeadd', [EmployeeController::class, 'employeeAdd'])->name('employeeadd');
            Route::get('/employee-details/{id}', [EmployeeController::class, 'employeeDetails'])->name('employee-details');
            Route::get('/employee-edit/{id}', [EmployeeController::class, 'employeeEdit'])->name('employee-edit');
            Route::post('/employeeupdate', [EmployeeController::class, 'employeeUpdate'])->name('employeeupdate');
            Route::post('/employeedelete', [EmployeeController::class, 'employeeDelete'])->name('employeedelete');

            Route::get('/permission', [PermissionController::class, 'permissionDetail'])->name('permission');
            Route::post('permission-approvel/',[PermissionController::class, 'permissionApprovel'])->name('permission-approvel');
            Route::post('permission-deny/',[PermissionController::class, 'permissionDeny'])->name('permission-deny');
    
            Route::get('/attendance-list', [EmployeeController::class, 'attendanceList'])->name('attendance-list');
            Route::get('/attendance-list-pagination', [EmployeeController::class, 'attendanceListPagination'])->name('attendance-list-pagination');
    
            Route::get('/absent-list', [EmployeeController::class, 'absentList'])->name('absent-list');
            Route::get('/absent-list-pagination', [EmployeeController::class, 'absentListPagination'])->name('absent-list-pagination');
    
            Route::get('/permission-list', [EmployeeController::class, 'permissionList'])->name('permission-list');
            Route::get('/permission-list-pagination', [EmployeeController::class, 'permissionListPagination'])->name('permission-list-pagination');
         
        });
