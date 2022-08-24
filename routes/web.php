<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ItineraryController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\LogoutController;

Auth::routes();
Route::post('sign-in', [AdminController::class, 'executeSignIn'])->name('execute.signin');
Route::post('reset-pass', [AdminController::class, 'sendResetLinkEmail'])->name('exe.forgot');
Route::get('register-2', [AdminController::class, 'formRegister'])->name('form.register');
Route::post('register-2', [AdminController::class, 'register2'])->name('register2');
Route::get('reset/{token}', [AdminController::class, 'formReset'])->name('form.reset');
Route::post('reset', [AdminController::class, 'Reset'])->name('reset');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
    
    Route::get('/', [DashController::class, 'index'])->name('dashboard');

    Route::resource('types', TypeController::class)->except(['show']);
    Route::group(['prefix' => 'types', 'as' => 'types.'], function () {
        Route::get('/{id}/show', [TypeController::class, 'show'])->name('show');
        Route::post('/getData', [TypeController::class, 'getData'])->name('getData');
        Route::post('/changeStatus', [TypeController::class, 'changeStatus'])->name('changeStatus');
    });

    Route::resource('destinations', DestinationController::class)->except('show');
    Route::group(['prefix' => 'destinations', 'as' => 'destinations.'], function () {
        Route::get('/{id}/show', [DestinationController::class, 'show'])->name('show');
        Route::post('/getData', [DestinationController::class, 'getData'])->name('getData');
        Route::post('/changeStatus', [DestinationController::class, 'changeStatus'])->name('changeStatus');
        // Route::post('/update/{destination_id}', [DestinationController::class, 'update'])->name('update');
    });

    Route::resource('tours', TourController::class)->except('show');
    Route::group(['prefix' => 'tours'], function () {
        Route::post('/getData', [TourController::class, 'getData'])->name('tours.getData');
        Route::post('/changeStatus', [TourController::class, 'changeStatus'])->name('tours.changeStatus');
        Route::post('/changeStatusTrending', [TourController::class, 'changeStatusTrending'])->name('tours.changeStatusTrending');
    });

    Route::group(['prefix' => 'tours/{tour_id}/itineraries', 'as' => 'itineraries.'], function () {
        Route::post('/getData', [ItineraryController::class, 'getData'])->name('getData');
        Route::get('{id}/showInfo', [ItineraryController::class, 'showInfo'])->name('showInfo');
        Route::get('', [ItineraryController::class, 'show'])->name('show');
        Route::get('/create', [ItineraryController::class, 'create'])->name('create');
        Route::post('/store', [ItineraryController::class, 'store'])->name('store');
        Route::get('/edit/{itinerary_id}', [ItineraryController::class, 'edit'])->name('edit');
        Route::post('/update/{itinerary_id}', [ItineraryController::class, 'update'])->name('update');
        Route::delete('/destroy', [ItineraryController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'tours/{tour_id}/itineraries/{itineraries_id}/places', 'as' => 'places.'], function () {
        Route::post('/getData', [PlaceController::class, 'getData'])->name('getData');
        Route::get('{id}/showInfo', [PlaceController::class, 'showInfo'])->name('showInfo');
        Route::get('', [PlaceController::class, 'show'])->name('show');
        Route::get('/create', [PlaceController::class, 'create'])->name('create');
        Route::post('/store', [PlaceController::class, 'store'])->name('store');
        Route::get('/edit/{place_id}', [PlaceController::class, 'edit'])->name('edit');
        Route::post('/update/{place_id}', [PlaceController::class, 'update'])->name('update');
    });
    Route::delete('{itineraries_id}/destroy/{id}', [PlaceController::class, 'destroy'])->name('places.destroy');

    Route::group(['prefix' => 'tours/{tour_id}/faqs', 'as' => 'faqs.'], function () {
        Route::post('/getData', [FaqController::class, 'getData'])->name('getData');
        Route::get('{id}/showInfo', [FaqController::class, 'showInfo'])->name('showInfo');
        Route::get('', [FaqController::class, 'show'])->name('show');
        Route::get('/create', [FaqController::class, 'create'])->name('create');
        Route::post('/store', [FaqController::class, 'store'])->name('store');
        Route::get('/edit/{faq_id}', [FaqController::class, 'edit'])->name('edit');
        Route::post('/update/{faq_id}', [FaqController::class, 'update'])->name('update');
        Route::delete('/destroy', [FaqController::class, 'destroy'])->name('destroy');
        Route::post('/changeStatus', [FaqController::class, 'changeStatus'])->name('changeStatus');
    });

    Route::group(['prefix' => 'tours/{tour_id}/galleries', 'as' => 'galleries.'], function () {
        Route::get('', [GalleryController::class, 'show'])->name('show');
        Route::post('/store', [GalleryController::class, 'store'])->name('store');
        Route::delete('{id}/destroy', [GalleryController::class, 'destroy'])->name('destroy');
    });

    // Route::resource('reviews', ReviewController::class)->except('show');
    Route::group(['prefix' => 'tours/{tour_id}/reviews', 'as' => 'reviews.'], function () {
        Route::post('/getData', [ReviewController::class, 'getData'])->name('getData');
        Route::get('', [ReviewController::class, 'show'])->name('show');
        Route::delete('destroy', [ReviewController::class, 'destroy'])->name('destroy');
        Route::post('/changeStatus', [ReviewController::class, 'changeStatus'])->name('changeStatus');
    });

    Route::resource('contacts', ContactController::class)->except('show');
    Route::group(['prefix' => 'contacts', 'as' => 'contacts.'], function () {
        Route::post('/getData', [ContactController::class, 'getData'])->name('getData');
        Route::post('/changeStatus', [ContactController::class, 'changeStatus'])->name('changeStatus');
    });

    Route::group(['prefix' => 'bookings', 'as' => 'bookings.'], function () {
        Route::get('', [BookingController::class, 'index'])->name('index');
        Route::post('/getData', [BookingController::class, 'getData'])->name('getData');
        Route::post('/changeStatus', [BookingController::class, 'changeStatus'])->name('changeStatus');
        Route::post('/paymentStatus', [BookingController::class, 'paymentStatus'])->name('paymentStatus');
    });
});

Route::post('{tour_id}/store', [ReviewController::class, 'store'])->name('reviews.store');

// client
Route::get('/', [ClientController::class, 'index'])->name('index');
Route::get('/tours', [ClientController::class, 'tours'])->name('tours');
Route::get('/{slug}/detail', [ClientController::class, 'detailTour'])->name('detailTour');

Route::get('/{slug}/checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::post('stripe-pay', [PaymentController::class, 'stripe'])->name('stripe');
Route::post('store-stripe-pay/{id}', [PaymentController::class, 'stripePost'])->name('stripe.post');
Route::get('/thanks/{id}', [PaymentController::class, 'paymentSuccess'])->name('paymentSuccess');
Route::get('/refund/{id}', [PaymentController::class, 'stripeRefund'])->name('stripeRefund');

Route::get('/contact', function() {
    return view('clients.contact');
})->name('contact');
Route::get('/layout', function () {
    return view('layouts.template');
});
