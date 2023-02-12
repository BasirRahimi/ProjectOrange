<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\AccessController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('dashboard');
    } else {
        return response()->view('welcome');
    }
});

Route::get('/request-access', [RegisterController::class, 'showRequestAccess'])->middleware('no.access');

Route::post('/request-access', [RegisterController::class, 'requestAccess']);
Route::post('/request-access/sms-verification', [RegisterController::class, 'smsVerification']);
Route::post('/request-access/phone-verified', [RegisterController::class, 'phoneVerified']);
Route::post('/request-access/save-user-details', [RegisterController::class, 'saveUserDetails']);

Auth::routes(['verify' => true]);


Route::middleware(['has.access'])->group(function () {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('clients', ClientController::class);

    Route::get('/clients/{id}/{vue_capture?}', [ClientController::class, 'show'])->where('vue_capture', '[\/\w\.-]*');

    Route::post('/clients/{id}/upload', [ClientController::class, 'fileUpload']);

    Route::get('/storage/userUploads/{user_id}/clientFiles/{client_id}/{filename}', [ClientController::class, 'requestFile']);


    //Reminders
    Route::post('/reminders/{client_id}', [ReminderController::class, 'store']);
});

Route::middleware(['is.admin'])->group(function () {
    Route::get('/grant-access', [AccessController::class, 'index'])->name('grant-access');
    Route::post('/grant-access/{user_id}', [AccessController::class, 'grantAccess']);
    Route::post('/deny-access/{user_id}', [AccessController::class, 'denyAccess']);
});
