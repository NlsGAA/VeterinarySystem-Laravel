<?php

use App\Http\Controllers\vetController;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

Route::middleware(['web', 'auth:sanctum'])->group(function(){
    Route::get('/', [vetController::class, 'home'])->name('home');
    Route::get('/cadastro', [vetController::class, 'cadastroUser']);
    Route::get('/signUpPage', [vetController::class, 'registerUser']);
    
    Route::get('/fichaTecnica', [vetController::class, 'ficha'])->middleware('auth');
    Route::get('/fichaTecnica/{id}', [vetController::class, 'show'])->middleware('auth');
    Route::get('/fichaTecnica/edit/{id}', [vetController::class, 'edit'])->name('patient.edit')->middleware('auth');
    
    // Route::get('/dashboard', [vetController::class, 'dashboard'])->name('patient.dashboard');
    Route::get('/internamentos', [vetController::class, 'internamentos'])->name('patient_hospitalized');
    
    Route::get('/owners', [vetController::class, 'ownersCreate'])->name('owners');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
