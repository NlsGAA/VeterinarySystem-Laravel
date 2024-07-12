<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// 'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
Route::post('/login', 'App\Http\Controllers\AuthController@login');

Route::middleware(['auth:sanctum', 'auth'])
    ->group(function(){

        Route::prefix('patients')->group(function(){
            Route::get('/', 'App\Http\Controllers\PatientsController@index')->name('patient.all');
            Route::post('/update', 'App\Http\Controllers\PatientsController@update')->name('patient.update');
            Route::get('/delete/{id}', 'App\Http\Controllers\PatientsController@delete')->name('patient.destroy');
            Route::post('/create', 'App\Http\Controllers\PatientsController@store')->name('patient.create');
        });
});


// Route::middleware(['auth:sanctum'])->group(function () {
// });

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
