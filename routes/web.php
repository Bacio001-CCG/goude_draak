<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CheckoutController;
use App\Http\Middleware\AdminCheck;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/register', [AuthenticationController::class, 'register'])->name('register.post');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(
    function () {

        Route::prefix('checkout')->group(function () {

            Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
        });

        Route::prefix('admin')->middleware(AdminCheck::class)->group(function () {

            Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        });
    }
);
