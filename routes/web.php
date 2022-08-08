<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

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

