<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CheckoutController;
use App\Http\Middleware\AdminCheck;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\PublicMenuController;
use App\Http\Controllers\AdminScheduleController;
use App\Http\Controllers\TableController;

Route::post('table/{id}', [TableController::class, 'store'])->name('table.store');
Route::resource('table', TableController::class)->except(['store']);


Route::get('/', function () {
    return view('public.home');
})->name('home');

Route::get('/contact', function () {
    return view('public.contact');
})->name('contact');

Route::get('/menu', function () {
    return view('public.menu');
})->name('menu');

Route::get('/news', function () {
    return view('public.news');
})->name('news');

Route::prefix('menu')->group(function () {
    Route::get('/', [PublicMenuController::class, 'show'])->name('menu.show');
    Route::get('/menu-download', [PublicMenuController::class, 'downloadMenuPdf'])->name('menu.download');
});

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

        Route::resource('checkout', CheckoutController::class);
        Route::post('checkout-add/{checkout}', [CheckoutController::class, 'add']);
        Route::post('checkout-remove/{checkout}', [CheckoutController::class, 'remove']);
        Route::post('note-add', [CheckoutController::class, 'noteAdd']);

        Route::prefix('admin')->name('admin.')->middleware(AdminCheck::class)->group(function () {

            Route::get('/', [AdminController::class, 'index'])->name('index');
            Route::resource('menu', AdminMenuController::class)->except(['show']);
            Route::resource('schedule', AdminScheduleController::class)->except(['show', 'edit', 'update', 'destroy']);
        });
    }
);

Route::post('locale', function () {
    // Validate
    $validated = request()->validate([
        'language' => ['required'],
    ]);
    // Set locale
    App::setLocale($validated['language']);
    // Session
    session()->put('locale', $validated['language']);
    // Response
    return redirect()->back();
});


