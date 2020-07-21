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

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if(Auth::check()){
        return redirect()->action('HomeController@index');
    } else {
        return redirect()->action('Auth\LoginController@showLoginForm');
    }
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::resource('clients', 'ClientController');

Route::get('/clients/{id}/{vue_capture?}', 'ClientController@show')->where('vue_capture', '[\/\w\.-]*');

Route::get('/phpinfo', function() {
    if(Auth::check()){
        return phpinfo();
    } else {
        return redirect()->action('Auth\LoginController@showLoginForm');
    }
});