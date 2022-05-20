<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\employee\LoginController;
use App\Http\Controllers\api\employee\AttendanceController;
use App\Http\Controllers\api\employee\TaskController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['namespace'=>'api'], function(){

       //Login and Logout
       Route::post('/login-employee', [LoginController::class, 'loginEmployee'])->name('login');
       Route::post('/logout',[LoginController::class,'logout']);

     
// Route::group(['middleware'=>'auth:api'],function () {
        //Attendance
        Route::post('attendance-status',[AttendanceController::class,'attendanceStatus']);

        //Task 
        Route::post('/task-add',[TaskController::class, 'taskAdd']);
        Route::post('/task-Details',[TaskController::class, 'taskDetails']);
        Route::post('/task-Drop-Details',[TaskController::class, 'taskDropdetails']);



// });
});
 

