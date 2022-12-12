<?php

use App\Http\Controllers\Client\AuthController;
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

Route::controller(AuthController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('register', 'registerView')
            ->name('register');
        Route::post('register', 'registerStore');

        Route::get('login', 'loginView')
            ->name('login');
        Route::post('login', 'loginStore');
    });

    Route::middleware('auth')->group(function () {
        Route::any('logout', 'destroy')->name('logout');
    });
});
