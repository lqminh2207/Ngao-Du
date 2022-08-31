<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\TourController;
use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\ItineraryController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('sign-in', [AdminController::class, 'executeSignIn'])->name('execute.signin');
Route::post('register-2', [AdminController::class, 'register2'])->name('register2');
Route::post('reset/{token}', [AdminController::class, 'formReset'])->name('form.reset');
Route::post('reset-pass', [AdminController::class, 'sendResetLinkEmail'])->name('exe.forgot');

// Route::middleware('auth:api')->group( function () {
Route::middleware('auth:api')->group( function () {
    Route::post('logout', [AdminController::class, 'logout'])->name('logout');

    Route::resource('types', TypeController::class)->only(['store', 'update', 'destroy']);
    Route::group(['prefix' => 'types', 'as' => 'types.'], function () {
        Route::get('/{id}/show', [TypeController::class, 'show'])->name('show');
        Route::post('/getData', [TypeController::class, 'getData'])->name('getData');
    });

    Route::resource('destinations', DestinationController::class)->only(['store', 'update', 'destroy']);
    Route::group(['prefix' => 'destinations', 'as' => 'destinations.'], function () {
        Route::get('/{id}/show', [DestinationController::class, 'show'])->name('show');
        Route::post('/{destination}/update', [DestinationController::class, 'update'])->name('update');
        Route::post('/getData', [DestinationController::class, 'getData'])->name('getData');
    });

    Route::resource('tours', TourController::class)->only(['store', 'update', 'destroy']);
    Route::group(['prefix' => 'tours'], function () {
        Route::post('/getData', [TourController::class, 'getData'])->name('tours.getData');
        Route::post('/{tour}/update', [TourController::class, 'update'])->name('update'); 
    });

    Route::post('itineraries/getAllData', [ItineraryController::class, 'getAllData'])->name('getAllData');
    Route::group(['prefix' => 'tours/{tour_id}/itineraries', 'as' => 'itineraries.'], function () {
        Route::post('/getData', [ItineraryController::class, 'getData'])->name('getData');
        Route::get('{id}/showInfo', [ItineraryController::class, 'showInfo'])->name('showInfo');
        Route::post('/store', [ItineraryController::class, 'store'])->name('store');
        Route::post('{itinerary}/update', [ItineraryController::class, 'update'])->name('update');
        Route::delete('{itinerary}/destroy', [ItineraryController::class, 'destroy'])->name('destroy');
    });

    Route::post('places/getAllData', [PlaceController::class, 'getAllData'])->name('getAllData');
    Route::group(['prefix' => 'tours/{tour_id}/itineraries/{itineraries}/places', 'as' => 'places.'], function () {
        Route::post('/getData', [PlaceController::class, 'getData'])->name('getData');
        Route::get('{id}/showInfo', [PlaceController::class, 'showInfo'])->name('showInfo');
        Route::post('/store', [PlaceController::class, 'store'])->name('store');
        Route::post('{place}/update', [PlaceController::class, 'update'])->name('update');
        Route::delete('{place}/destroy', [PlaceController::class, 'destroy'])->name('destroy');
    });

    Route::post('faqs/getAllData', [FaqController::class, 'getAllData'])->name('getAllData');
    Route::group(['prefix' => 'tours/{tour_id}/faqs', 'as' => 'faqs.'], function () {
        Route::post('/getData', [FaqController::class, 'getData'])->name('getData');
        Route::get('{id}/showInfo', [FaqController::class, 'showInfo'])->name('showInfo');
        Route::post('/store', [FaqController::class, 'store'])->name('store');
        Route::post('{faq_id}/update', [FaqController::class, 'update'])->name('update');
        Route::delete('{itinerary}/destroy', [FaqController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'tours/{tour_id}/galleries', 'as' => 'galleries.'], function () {
        Route::post('/store', [GalleryController::class, 'store'])->name('store');
        Route::delete('{id}/destroy', [GalleryController::class, 'destroy'])->name('destroy');
    });

    Route::post('reviews/getAllData', [ReviewController::class, 'getAllData'])->name('getAllData');
    Route::group(['prefix' => 'tours/{tour_id}/reviews', 'as' => 'reviews.'], function () {
        Route::post('/getData', [ReviewController::class, 'getData'])->name('getData');
        Route::delete('{review}/destroy', [ReviewController::class, 'destroy'])->name('destroy');
    });

    Route::resource('contacts', ContactController::class)->only(['store', 'destroy']);
    Route::group(['prefix' => 'contacts', 'as' => 'contacts.'], function () {
        Route::post('getAllData', [ContactController::class, 'getAllData'])->name('getAllData');
    });

    Route::group(['prefix' => 'bookings', 'as' => 'bookings.'], function () {
        Route::post('getAllData', [BookingController::class, 'getAllData'])->name('getAllData');
    });
});

Route::post('tours/{tour_id}/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');
Route::post('contacts/store', [ContactController::class, 'store'])->name('contacts.store');

Route::post('optionsPayment', [BookingController::class, 'optionsPayment'])->name('optionsPayment');
Route::get('stripe-pay/{id}', [BookingController::class, 'stripe'])->name('stripe');
Route::post('store-stripe-pay/{id}', [BookingController::class, 'stripePost'])->name('stripe.post');
Route::get('/thanks/{id}', [BookingController::class, 'paymentSuccess'])->name('paymentSuccess');
Route::post('/refund/{id}', [BookingController::class, 'stripeRefund'])->name('stripeRefund');

Route::get('momoPayment/{booking}', [BookingController::class, 'momoPayment'])->name('momoPayment');

Route::get('zaloPayment/{id}', [BookingController::class, 'zaloPayment'])->name('zaloPayment');
Route::post('/ipnMomo/{bookingID}', [BookingController::class, 'ipnMomo'])->name('ipnMomo');
