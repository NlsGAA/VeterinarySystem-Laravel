<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// 'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',

Route::get('/', 'App\Http\Controllers\PatientsController@index');
Route::post('/create', 'App\Http\Controllers\PatientsController@store')->name('animal.create');
Route::delete('/delete/{id}', 'PatientController@delete')->name('animal.destroy');
Route::get('/update/{id}', 'PatientController@edit')->name('animal.update');


// Route::middleware(['auth:sanctum'])->group(function () {
// });

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
