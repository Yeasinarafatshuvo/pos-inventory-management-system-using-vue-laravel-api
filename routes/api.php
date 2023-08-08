<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/user_login', [AuthController::class, 'user_login']);
Route::post('/user_registration', [AuthController::class, 'user_registration']);

Route::group(["middleware" => ["auth:api"]], function(){
    Route::get('/user_logout', [AuthController::class, 'user_logout']);
    Route::post('/store_employee', [EmployeeController::class, 'store_employee']);
    Route::get('/getAllEmployee', [EmployeeController::class, 'getAllEmployee']);
    Route::get('/employee_specefic_data/{id}', [EmployeeController::class, 'get_sepecefic_employee_data']);
    Route::put('/update_employee/{id}', [EmployeeController::class, 'update_employee']);

});
