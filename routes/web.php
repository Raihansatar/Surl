<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Url\UrlController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UrlController::class, 'index'])->name('welcome');



Route::get('/login', [LoginController::class, 'loginPage'])->name('login');
Route::post('/login', [LoginController::class, 'loginAttempt'])->name('login.attempt');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/register', [RegisterController::class, 'create'])->name('register');

Route::middleware(['auth'])->group(function () {
    Route::post('/url/store', [UrlController::class, 'store'])->name('url.store');
    Route::get('/{shortUrl}', [UrlController::class, 'redirectUser'])->name('url.redirect');
});
