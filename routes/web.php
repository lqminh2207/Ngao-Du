<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\LogoutController;

Auth::routes();
Route::post('sign-in', [AdminController::class, 'executeSignIn'])->name('execute.signin');
Route::post('reset-pass', [AdminController::class, 'sendResetLinkEmail'])->name('exe.forgot');
Route::get('register-2', [AdminController::class, 'formRegister'])->name('form.register');
Route::post('register-2', [AdminController::class, 'register2'])->name('register2');
Route::get('reset', [AdminController::class, 'formReset'])->name('form.reset');
Route::post('reset', [AdminController::class, 'Reset'])->name('reset');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
    
    Route::get('/', [DashController::class, 'index'])->name('dashboard');

});

Route::get('/', function() {
    return view('clients.index');
})->name('index');
Route::get('/tours', function() {
    return view('clients.tours');
})->name('tours');
Route::get('/contact', function() {
    return view('clients.contact');
})->name('contact');
Route::get('/checkout', function() {
    return view('clients.checkout');
})->name('checkout');
Route::get('/thanks', function() {
    return view('clients.thanks');
})->name('thanks');
Route::get('/layout', function () {
    return view('layouts.template');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
