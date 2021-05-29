<?php

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

Route::get('/', \App\Http\Controllers\PaginateController::class)
    ->name('home');

Route::middleware('guest')->group(function () {

    Route::get('/login', \App\Http\Controllers\AuthController::class . '@login')
        ->name('login');

    Route::post('/login', \App\Http\Controllers\AuthController::class . '@check');

    Route::get('/register', \App\Http\Controllers\RegisterController::class . '@form')
        ->name('register');

    Route::post('/register', \App\Http\Controllers\RegisterController::class . '@register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', \App\Http\Controllers\AuthController::class . '@logout')
        ->name('logout');

    Route::get('/delete/{id?}', \App\Http\Controllers\CRUDController::class . '@delete')
        ->name('delete');

    Route::get('/update/{id?}', \App\Http\Controllers\CRUDController::class . '@find')
        ->name('update');

    Route::post('/update/{id?}', \App\Http\Controllers\CRUDController::class . '@update');

    Route::get('/ad_view/{id?}', \App\Http\Controllers\AuthController::class . '@ad_view')
        ->name('ad_view');

    Route::get('/create', \App\Http\Controllers\CRUDController::class . '@form')
        ->name('create');

    Route::post('/create', \App\Http\Controllers\CRUDController::class . '@create');

    Route::get('my_posts' , \App\Http\Controllers\AuthController::class . '@show')
        ->name('show');
});
