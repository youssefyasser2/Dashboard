<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;

// Registration and login pages
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Home page where employees appear
Route::get('/home', [EmployeeController::class, 'index'])->middleware('auth')->name('home');

// Employee Management Pages
Route::get('/employees/create', [EmployeeController::class, 'create'])->middleware('auth')->name('employees.create');
Route::post('/employees', [EmployeeController::class, 'store'])->middleware('auth')->name('employees.store');
Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->middleware('auth')->name('employees.edit');
Route::put('/employees/{id}', [EmployeeController::class, 'update'])->middleware('auth')->name('employees.update');
Route::get('/employees', [EmployeeController::class, 'index'])->middleware('auth')->name('employees.index');

// Default Home Page
Route::get('/', function () {
    return redirect()->route('home');
});

// User delete pages
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy')->middleware('auth');
