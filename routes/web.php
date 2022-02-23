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

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');

Route::middleware('loggedin')->group(function () {
    Route::get('login', [AuthController::class, 'loginView'])->name('login-view');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [PageController::class, 'dashboardOverview1'])->name('dashboard-overview-1');
});

Route::get('/employee-form', [EmployeeController::class, 'employeeForm'])->name('employee-form');
Route::post('/employee-add', [EmployeeController::class, 'employeeAdd'])->name('employee-add');
Route::get('/employee-list', [EmployeeController::class, 'employeeList'])->name('employee-list');
Route::get('/employee-details/{id}', [EmployeeController::class, 'employeeDetails'])->name('employee-details');
Route::get('/employee-edit/{id}', [EmployeeController::class, 'employeeEdit'])->name('employee-edit');
Route::post('/employee-update', [EmployeeController::class, 'employeeUpdate'])->name('employee-update');
Route::post('/employee-delete', [EmployeeController::class, 'employeeDelete'])->name('employee-delete');


Route::get('/attendance', [EmployeeController::class, 'adminAttendance'])->name('admin-attendance-module');


Route::get('/file-upload', [EmployeeController::class, 'fileUpload'])->name('file-upload');
Route::post('/employee-list-import', [EmployeeController::class, 'employeeListImport'])->name('employee-list-import');
Route::get('/employee-list-export', [EmployeeController::class, 'employeeListExport'])->name('employee-list-export');


//employee register and login start

Route::group(['prefix'=> 'employee'], function(){
Route::get('register-form',[LoginController::class, 'registerForm'])->name('register-view');
Route::get('user-register/{id}',[LoginController::class, 'registerEmployee'])->name('user-register');
Route::post('user-dashboard',[LoginController::class, 'userDashboard'])->name('user-dashboard');
Route::get('login-form', [LoginController::class, 'loginForm'])->name('view-dashboard');
Route::get('login-form-mail/{id}', [LoginController::class, 'loginForm'])->name('login-view-mail');
Route::post('login-employee', [LoginController::class, 'loginEmployee'])->name('employee-login');
Route::get('forgot-password', [LoginController::class, 'forgotPasswordForm'])->name('forgot-view');


// Attendance  

Route::get('attendance-module',[AttendanceController::class, 'attendanceModule'])->name('attendance-module');
Route::Post('attendance-status',[AttendanceController::class,'attendanceStatus'])->name('attendance-status');
Route::get('leave-request/{id}',[AttendanceController::class, 'leaveRequest'])->name('leave-request');
Route::post('leave-status',[AttendanceController::class, 'leaveStatus'])->name('leave-status');
Route::post('leave-accpeted/{id}/{status}',[AttendanceController::class, 'leaveAccepted'])->name('leave-accepted');
Route::post('attendance-list',[AttendanceController::class, 'attendanceList'])->name('attendance-list');

});

//employee register and login end0
