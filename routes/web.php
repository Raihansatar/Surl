<?php

use App\Http\Controllers\HomeController;
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

// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/url/store', [UrlController::class, 'store'])->name('url.store');

// Route::get('/{code}', [UrlController::class], 'redirectto')->name('url.redirect');
Route::get('/{shortUrl}', [UrlController::class, 'redirectto'])->name('url.redirect');

