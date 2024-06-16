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
use App\Http\Controllers\ReviewController;

Route::post('restaurant/table/{id}', [TableController::class, 'store'])->name('table.store');
Route::get('restaurant/table/{table}', [TableController::class, 'show'])->name('table.show');
Route::get('restaurant/table/{table}/payment', [TableController::class, 'paymentScreen'])->name('table.paymentScreen');
Route::get('restaurant/table/{table}/pay', [TableController::class, 'pay'])->name('table.pay');
Route::get('restaurant/table/{table}/help', [TableController::class, 'helpScreen'])->name('table.help');
Route::post('restaurant/table/{table}/help', [TableController::class, 'help'])->name('table.store.help');
Route::get('restaurant', [TableController::class, 'activeTableOverview'])->name('table.overview');

Route::get('/review', [ReviewController::class, 'create'])->name('review.create');
Route::post('/review', [ReviewController::class, 'store'])->name('review.post');

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

        Route::resource('table', TableController::class)->except(['store', 'create', 'show', 'destroy']);
        Route::get('table/{table}/close', [TableController::class, 'close'])->name('table.close');
        Route::get('table/{table}/helprequest', [TableController::class, 'helpRequest'])->name('table.help.request');
        Route::get('table/{helpRequest}/completehelprequest', [TableController::class, 'completeHelpRequest'])->name('table.complete.request');

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
