<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function() {
    return view('pages.welcome');
})->name('welcome');


Route::post('/users/create', [UserController::class, 'create'])->name('users.create');


Route::prefix('profile')->group(function () {
    Route::get('/', function () {
        return view('pages.profile');
    })->name('profile');
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/stats', [UserController::class, 'stats'])->name('users.stats');
});

Route::prefix('auth')->group(function () {
    Route::post('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
});
