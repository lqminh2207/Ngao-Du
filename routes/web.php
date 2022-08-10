<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\ItineraryController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\TypeController;
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

    Route::resource('types', TypeController::class)->except(['show']);
    Route::group(['prefix' => 'types', 'as' => 'types.'], function () {
        Route::post('/getData', [TypeController::class, 'getData'])->name('getData');
        Route::post('/changeStatus', [TypeController::class, 'changeStatus'])->name('changeStatus');
    });

    Route::resource('destinations', DestinationController::class)->except('show');
    Route::group(['prefix' => 'destinations', 'as' => 'destinations.'], function () {
        Route::post('/getData', [DestinationController::class, 'getData'])->name('getData');
        Route::post('/changeStatus', [DestinationController::class, 'changeStatus'])->name('changeStatus');
    });

    Route::resource('tours', TourController::class)->except('show');
    Route::group(['prefix' => 'tours'], function () {
        Route::post('/getData', [TourController::class, 'getData'])->name('tours.getData');
        Route::post('/changeStatus', [TourController::class, 'changeStatus'])->name('tours.changeStatus');
        Route::post('/changeStatusTrending', [TourController::class, 'changeStatusTrending'])->name('tours.changeStatusTrending');
    });

    Route::group(['prefix' => 'tours/{tour_id}/itineraries', 'as' => 'itineraries.'], function () {
        Route::post('/getData', [ItineraryController::class, 'getData'])->name('getData');
        Route::get('', [ItineraryController::class, 'show'])->name('show');
        Route::get('/create', [ItineraryController::class, 'create'])->name('create');
        Route::post('/store', [ItineraryController::class, 'store'])->name('store');
        Route::get('/edit/{itinerary_id}', [ItineraryController::class, 'edit'])->name('edit');
        Route::post('/update/{itinerary_id}', [ItineraryController::class, 'update'])->name('update');
        Route::post('/destroy/{itinerary_id}', [ItineraryController::class, 'destroy'])->name('destroy');
    });

    Route::resource('contacts', ContactController::class)->except('show');
    Route::group(['prefix' => 'contacts', 'as' => 'contacts.'], function () {
        Route::post('/getData', [ContactController::class, 'getData'])->name('getData');
        Route::post('/changeStatus', [ContactController::class, 'changeStatus'])->name('changeStatus');
    });
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
