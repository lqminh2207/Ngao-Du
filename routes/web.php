<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashController;
use App\Http\Controllers\Admin\AdminController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::post('sign-in', [AdminController::class, 'executeSignIn'])->name('execute.signin');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    // Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
    
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
Route::get('/slug', function() {
    return view('clients.slug-tour');
})->name('slug');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
