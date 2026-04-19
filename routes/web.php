<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SmsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    return view('welcome');
})->name('home');

Route::view('services', 'services')->name('services.show');
Route::view('terms', 'terms')->name('terms.show');
Route::get('contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::view('app', 'dashboard')->name('app');
    Route::redirect('dashboard', '/app')->name('dashboard');
    Route::post('sms/send', [SmsController::class, 'send'])->name('sms.send');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
