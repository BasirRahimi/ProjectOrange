<?php
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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    if(Auth::check()){
        return redirect('dashboard');
    } else {
        return response()->view('welcome');
    }
});

Route::get('/request-access', 'Auth\RegisterController@showRequestAccess')->middleware('no.access');

Route::post('/request-access', 'Auth\RegisterController@requestAccess');
Route::post('/request-access/sms-verification', 'Auth\RegisterController@smsVerification');
Route::post('/request-access/phone-verified', 'Auth\RegisterController@phoneVerified');
Route::post('/request-access/save-user-details', 'Auth\RegisterController@saveUserDetails');

Auth::routes(['verify' => true]);


Route::middleware(['has.access'])->group(function() {

    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    
    Route::resource('clients', 'ClientController');
    
    Route::get('/clients/{id}/{vue_capture?}', 'ClientController@show')->where('vue_capture', '[\/\w\.-]*');
    
    Route::post('/clients/{id}/upload', 'ClientController@fileUpload');
    
    Route::get('/storage/userUploads/{user_id}/clientFiles/{client_id}/{filename}', 'ClientController@requestFile');
    
    
    //Reminders
    Route::post('/reminders/{client_id}', 'ReminderController@store');
});

Route::middleware(['is.admin'])->group(function() {
    Route::get('/grant-access', 'AccessController@index')->name('grant-access');
    Route::post('/grant-access/{user_id}', 'AccessController@grantAccess');
    Route::post('/deny-access/{user_id}', 'AccessController@denyAccess');
});


// Temp Dev Routes
Route::get('/phpinfo', function() {
    if(Auth::check()){
        return phpinfo();
    } else {
        return redirect()->action('Auth\LoginController@showLoginForm');
    }
});