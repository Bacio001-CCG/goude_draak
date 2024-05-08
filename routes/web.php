<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

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

        Route::get('/checkout', function () {
            return view('checkout.index');
        })->name('checkout.index');
    }
);
