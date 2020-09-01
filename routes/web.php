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

Route::get('/dashboard', 'HomeController@index')->name('dashboard')->middleware('has.access');

Route::resource('clients', 'ClientController')->middleware('has.access');

Route::get('/clients/{id}/{vue_capture?}', 'ClientController@show')->where('vue_capture', '[\/\w\.-]*')->middleware('has.access');

Route::get('/phpinfo', function() {
    if(Auth::check()){
        return phpinfo();
    } else {
        return redirect()->action('Auth\LoginController@showLoginForm');
    }
});