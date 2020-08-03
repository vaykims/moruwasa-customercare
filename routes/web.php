<?php

use Illuminate\Support\Facades\Route;
use App\Technician;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'UserController@users');
Route::get('/viewUser/{id}', 'UserController@view');
Route::post('/addUser', 'UserController@add');
Route::post('/updateUser/{id}', 'UserController@update');
Route::get('/deleteUser/{id}', 'UserController@delete');
Route::get('/profile/{id}', 'UserController@viewProfile');
Route::post('/updateProfile/{id}', 'UserController@updateProfile');

// technician
Route::get('/view_tech', 'TechnicianController@view');
Route::post('/register_tech', 'TechnicianController@register');
Route::get('/updateTechnician/{id}', function($id){
    $technician = Technician::find($id);
    return view('technicians/updateTechnician', ['technician'=>$technician]);
});
Route::post('/update_tech/{id}', 'TechnicianController@update');
Route::get('/deleteTechnician/{id}', 'TechnicianController@delete');

// complaints
Route::get('/add_complaint','ComplaintController@view');
Route::post('/save_complaint','ComplaintController@add');
Route::get('/complaint','ComplaintController@complaints');
Route::post('/assignTechnician/{id}', 'ComplaintController@assignTask');
Route::get('/complaint_statuses', 'ComplaintController@complaintStatus');
Route::post('/send_complaint', 'CustomerComplaintController@customerComplaint');


// charts
Route::get('/complaints_data',[
    'as' => 'complaints_data.show',
    'uses' => 'Charts\ChartComplaintsController@getMonthlyComplaintData'
]);
Route::get('/complaint_status',[
    'as' => 'complaint_status.status',
    'uses' => 'Charts\ComplaintStatusController@getMonthlyComplaintStatus'
]);
Route::get('/complaint_location',[
    'as' => 'complaint_location.location',
    'uses' => 'Charts\ComplaintLocationController@getMonthlyComplaintLocation'
]);


// Route::any('/{page?}',function(){
//     return View::make('errors.404');
//   })->where('page','.*');