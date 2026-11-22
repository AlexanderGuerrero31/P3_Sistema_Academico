<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

// Cada rol va a su pantalla
Route::get('/dashboard', function () {
    return auth()->user()->role === 'profesor'
        ? redirect()->route('students.index')
        : redirect()->route('students.mine');
})->middleware('auth')->name('dashboard');

// Profesor: todas las operaciones
Route::middleware(['auth', 'role:profesor'])->group(function () {
    Route::resource('students', StudentController::class)->except(['show']);
});

// Alumno: solo consulta de su información
Route::get('/mi-informacion', [StudentController::class, 'mine'])
    ->middleware(['auth', 'role:alumno'])
    ->name('students.mine');    

require __DIR__.'/auth.php';
