<?php

use App\Http\Controllers\CaseController;
use App\Http\Controllers\CaseDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('has.access')->group(function () {
    // Cases are to replace clients completely
    Route::controller(CaseController::class)->group(function () {
        Route::get('/cases/{case_id?}', 'getCases'); // gets all user cases.
        Route::post('/cases/{case_type}', 'store'); // requires initial data to create the case
        Route::patch('/cases/{case_id}', 'update'); // updates part of a case
        Route::delete('/cases/{case_id}', 'softDelete'); // soft delete

        Route::post('/cases/{case_id}/upload', 'uploadFile');
    });

    Route::controller(CaseDataController::class)->group(function () {
        Route::get('/case-data/{case_id}', 'get');
        Route::post('/case-data/{case_id}', 'store');
    });
});
