<?php

use App\Http\Controllers\Auth\BackendController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/', [GalleryController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::get('/admin', [BackendController::class, 'index'])->middleware('auth')->name('admin');
Route::post('/admin', [BackendController::class, 'store'])->middleware('auth')->name('admin.store');
Route::delete('/admin', [BackendController::class, 'destroy'])->middleware('auth')->name('admin.destroy');