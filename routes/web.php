<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecordController;


// Public Routes (Login Page)
Route::middleware('guest')->group(function () {
    Route::get('/', fn() => view('auth.login'))->name('login');
    Route::get('/login', fn() => view('auth.login'))->name('login.page');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// Protected Routes (After Login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin routes - full access
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/records/aics', fn() => view('records.aics'))->name('records.aics');
    Route::get('/records/senior', fn() => view('records.senior'))->name('records.senior');
    Route::get('/records/solo', fn() => view('records.solo'))->name('records.solo');
    Route::get('/records/pwd', fn() => view('records.pwd'))->name('records.pwd');
    Route::get('/records/all', fn() => view('records.all'))->name('records.all');
});

// AICS or Admin can access AICS records
Route::middleware(['auth', 'role:aics,admin'])->group(function () {
    Route::get('/records/aics', fn() => view('records.aics'))->name('records.aics');
});

// Senior or Admin can access Senior records
Route::middleware(['auth', 'role:senior,admin'])->group(function () {
    Route::get('/records/senior', fn() => view('records.senior'))->name('records.senior');
});

// Solo or Admin can access Solo records
Route::middleware(['auth', 'role:solo,admin'])->group(function () {
    Route::get('/records/solo', fn() => view('records.solo'))->name('records.solo');
});

// PWD or Admin can access PWD records
Route::middleware(['auth', 'role:pwd,admin'])->group(function () {
    Route::get('/records/pwd', fn() => view('records.pwd'))->name('records.pwd');
});
