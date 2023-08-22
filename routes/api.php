<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SupplierController;
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

    //supplier route
    Route::post('/create_supplier', [SupplierController::class, 'create_supplier']);
    Route::get('/get_all_supplier', [SupplierController::class, 'get_all_supplier']);
    Route::get('/get_specefic_supplier_data/{id}', [SupplierController::class, 'get_specefic_supplier_data']);
    Route::put('/update_supplier/{id}', [SupplierController::class, 'update_supplier']);
    Route::delete('/delete_supplier/{id}', [SupplierController::class, 'delete_supplier']);
});