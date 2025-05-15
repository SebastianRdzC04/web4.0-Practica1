<?php

use App\Http\Controllers\AuthController;
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
    })->middleware('auth')->name('profile');
    Route::patch('/{id}', [ProfileController::class, 'edit'])->name('profile.update');

});

Route::prefix('admin')->middleware(['auth', 'role'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('admin.index');
    Route::get('/stats', [UserController::class, 'stats'])->name('admin.stats');
    Route::delete('/{id}', [UserController::class, 'delete'])->where('id', '[0-9]+')->name('admin.delete');
    Route::get('/profile', function () {
        return view('pages.profile');
    })->name('admin.profile');
});

Route::prefix('user')->middleware(['auth'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::patch('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/profile/{id}', [UserController::class, 'getUser'])->name('user.getUser');

});

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

});
