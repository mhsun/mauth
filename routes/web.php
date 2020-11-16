<?php

use App\Http\Controllers\Admin\Auth\ConfirmPasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')
    ->namespace('Admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::get('/password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])
            ->name('password.confirm.form');
        Route::post('/password/confirm', [ConfirmPasswordController::class, 'confirm'])
            ->name('password.confirm');

        Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
            ->name('password.email');
        Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
            ->name('password.request');

        Route::post('/password/reset', [ResetPasswordController::class, 'reset'])
            ->name('password.update');
        Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
            ->name('password.reset');
    });
