<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::apiResource('/technician', 'Api\v1\TechnicianController');
Route::apiResource('/customer', 'Api\v1\CustomerController');
Route::apiResource('/complaints', 'Api\v1\BillComplaintsController');
Route::apiResource('/billComplaintsTrend', 'Api\v1\BillComplaintsTrendController');
Route::apiResource('/billComplaintsLocation', 'Api\v1\BillComplaintsLocationController');
