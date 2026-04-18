<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SmsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    return view('welcome');
})->name('home');

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
