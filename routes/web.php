<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\SeniorController;

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

// Admin Only Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/records/aics', fn() => view('records.aics'))->name('records.aics');
    Route::get('/records/solo', fn() => view('records.solo'))->name('records.solo');
    Route::get('/records/pwd', fn() => view('records.pwd'))->name('records.pwd');
    Route::get('/records/all', fn() => view('records.all'))->name('records.all');
});

// AICS Program (AICS or Admin)
Route::middleware(['auth', 'role:aics,admin'])->group(function () {
    Route::get('/records/aics', fn() => view('records.aics'))->name('records.aics');
});

// Senior Program (Senior or Admin)
Route::middleware(['auth', 'role:senior,admin'])->group(function () {
    Route::get('/records/senior', [SeniorController::class, 'index'])->name('records.senior');
    Route::post('/seniors/store', [SeniorController::class, 'store'])->name('senior.store');
    Route::put('/seniors/{id}', [SeniorController::class, 'update'])->name('senior.update');
    Route::delete('/seniors/{id}', [SeniorController::class, 'destroy'])->name('senior.destroy');

});

// Solo Parent Program (Solo or Admin)
Route::middleware(['auth', 'role:solo,admin'])->group(function () {
    Route::get('/records/solo', fn() => view('records.solo'))->name('records.solo');
});

// PWD Program (PWD or Admin)
Route::middleware(['auth', 'role:pwd,admin'])->group(function () {
    Route::get('/records/pwd', fn() => view('records.pwd'))->name('records.pwd');
});
