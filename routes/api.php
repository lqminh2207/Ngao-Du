<?php

use App\Http\Controllers\Api\TourController;
use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\ItineraryController;
use App\Http\Controllers\Api\PlaceController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:api')->group( function () {
Route::middleware('api')->group( function () {
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
});

// Route::get('types', [TypeController::class, 'index']);
// Route::post('types/store', [TypeController::class, 'store']);
