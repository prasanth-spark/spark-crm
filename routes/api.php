<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\employee\LoginController;

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

// Route::middleware('loggedin')->group(function () {
    Route::post('/login-employee', [LoginController::class, 'loginEmployee'])->name('login');
    // Route::get('login-form-mail/{id}', [EmployeeController::class, 'loginFormMail'])->name('login-view-mail');
// });

// Route::get('/logout',[AuthController::class,'logout']);


});

