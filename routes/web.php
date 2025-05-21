<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeniorCitizenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->prefix('senior')->name('senior.')->group(function () {
    Route::get('/records', [SeniorCitizenController::class, 'index'])->name('records.index');

    Route::get('/records/create', [SeniorCitizenController::class, 'create'])->name('records.create');
    Route::post('/records', [SeniorCitizenController::class, 'store'])->name('records.store');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', fn() => view('dashboards.admin'));
    Route::get('/pwd/dashboard', fn() => view('dashboards.pwd'));
    Route::get('/aics/dashboard', fn() => view('dashboards.aics'));
    Route::get('/senior/dashboard', fn() => view('dashboards.senior'));
    Route::get('/solo/dashboard', fn() => view('dashboards.solo'));
});


//pwd
Route::middleware(['auth'])->group(function () {
    Route::get('/pwd/dashboard', function () {
        return view('dashboards.pwd.index');
    });
});

//admin
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboards.admin.index');
    });

    Route::get('/admin/records', function () {
        return view('dashboards.admin.records');
    });
});


//solo parent
Route::middleware(['auth'])->group(function () {
    Route::get('/solo/dashboard', function () {
        return view('dashboards.solo.index');
    });

    Route::get('/solo/records', function () {
        return view('dashboards.solo.records');
    });
});


//aics
Route::middleware(['auth'])->group(function () {
    Route::get('/aics/dashboard', function () {
        return view('dashboards.aics.index');
    });

    Route::get('/aics/records', function () {
        return view('dashboards.aics.records');
    });
});


//senior
Route::middleware(['auth'])->group(function () {
    Route::get('/senior/dashboard', function () {
        return view('dashboards.senior.index');
    });

//     Route::get('/senior/records', function () {
//         return view('dashboards.senior.records.index');
//     });
// });
});






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');



require __DIR__.'/auth.php';
