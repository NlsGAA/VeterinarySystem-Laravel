<?php

use App\Http\Controllers\vetController;
use Illuminate\Support\Facades\Route;

Route::get('/', [vetController::class, 'home']);

Route::get('/fichaTecnica', [vetController::class, 'ficha'])->middleware('auth');
Route::get('/fichaTecnica/{id}', [vetController::class, 'show'])->middleware('auth');
Route::get('/fichaTecnica/edit/{id}', [vetController::class, 'edit'])->name('patient.edit')->middleware('auth');

Route::get('/cadastro', [vetController::class, 'cadastroUser']);

Route::get('/signUpPage', [vetController::class, 'registerUser']);

Route::get('/dashboard', [vetController::class, 'dashboard'])->middleware('auth')->name('patient.dashboard');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
