<?php

use App\Http\Controllers\AvatarController;
use App\Http\Controllers\LoginGithubController;
use App\Http\Controllers\LoginGoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::patch('/profile/avatar', [AvatarController::class, 'update'])->name('profile.avatar');

    Route::post('profile/avatar', [AvatarController::class, 'generate'])->name('profile.generate');
});

require __DIR__ . '/auth.php';

Route::get('/auth/redirect', [LoginGithubController::class, 'redirect'])->name('login.github');

Route::get('/auth/callback', [LoginGithubController::class, 'callback']);

Route::get('/auth/google/redirect', [LoginGoogleController::class, 'redirect'])->name('login.google');

Route::get('/auth/google/callback', [LoginGoogleController::class, 'callback']);

Route::middleware('auth')->group(function () {
    Route::get('/ticket/create', [TicketController::class, 'create']);

});
