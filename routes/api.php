<?php

use Illuminate\Support\Facades\Route;
 
Route::post('/register', 'App\Http\Controllers\AuthController@register')->name('user.register');
Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('user.login');

Route::middleware(['auth:sanctum', 'auth'])
->group(function(){

    Route::prefix('user')->group(function(){
        Route::get('/', 'App\Http\Controllers\AuthController@authUser')->name('user.authUser');
        Route::post('/update', 'App\Http\Controllers\AuthController@update')->name('user.update');
    });
    
    Route::prefix('patients')->group(function(){
        Route::get('/', 'App\Http\Controllers\PatientsController@index')->name('patient.all');
        Route::get('/findPatient/{id}', 'App\Http\Controllers\PatientsController@show')->name('patient.show');
        Route::post('/update', 'App\Http\Controllers\PatientsController@update')->name('patient.update');
        Route::get('/delete/{id}', 'App\Http\Controllers\PatientsController@destroy')->name('patient.destroy');
        Route::post('/create', 'App\Http\Controllers\PatientsController@store')->name('patient.create');
        Route::post('/dashboard', 'App\Http\Controllers\PatientsController@dashboard')->name('patient.dashboard');
    });

    Route::prefix('types')->group(function() {
        Route::get('/weight', 'App\Http\Controllers\TypesController@index')->name('type.weight');
        Route::get('/situation', 'App\Http\Controllers\TypesController@index')->name('type.situation');
        Route::get('/reason', 'App\Http\Controllers\TypesController@index')->name('type.reason');
    });

    Route::prefix('owners')->group(function(){
        Route::get('/', 'App\Http\Controllers\OwnersController@index')->name('owners.all');
        Route::post('/update', 'App\Http\Controllers\OwnersController@update')->name('owners.update');
        Route::post('/delete/{id}', 'App\Http\Controllers\OwnersController@delete')->name('owners.delete');
    });

    Route::prefix('doctors')->group(function(){
        Route::get('/', 'App\Http\Controllers\UserController@index')->name('doctor.all');
    });

    Route::prefix('hospitalization')->group(function(){
        Route::get('/', 'App\Http\Controllers\HospitalizedController@index')->name('hospitalized.all');
        Route::post('/create', 'App\Http\Controllers\HospitalizedController@store')->name('hospitalized.create');
        Route::post('/{id}/update', 'App\Http\Controllers\HospitalizedController@update')->name('hospitalized.update');
        Route::post('/{id}/delete', 'App\Http\Controllers\HospitalizedController@delete')->name('hospitalized.delete');
    });
});