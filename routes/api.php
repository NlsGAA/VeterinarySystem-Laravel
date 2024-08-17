<?php

use Illuminate\Support\Facades\Route;
 
Route::post('/register', 'App\Http\Controllers\AuthController@register')->name('user.register');
Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('user.login');

Route::middleware(['auth:sanctum', 'auth'])
    ->group(function(){

        Route::prefix('patients')->group(function(){
            Route::get('/', 'App\Http\Controllers\PatientsController@index')->name('patient.all');
            Route::post('/update', 'App\Http\Controllers\PatientsController@update')->name('patient.update');//->middleware('ability:patient-update');
            Route::get('/delete/{id}', 'App\Http\Controllers\PatientsController@destroy')->name('patient.destroy');//->middleware('ability:patient-delete');
            Route::post('/create', 'App\Http\Controllers\PatientsController@store')->name('patient.create');//->middleware('ability: patient-create');
        });

        Route::prefix('doctors')->group(function(){
            Route::get('/', 'App\Http\Controllers\UserController@index')->name('doctor.all');
        });

        Route::prefix('hospitalization')->group(function(){
            Route::get('/', 'App\Http\Controllers\HospitalizedController@index')->name('hospitalized.all');
        });
});