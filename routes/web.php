<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;

Route::post('/contact', [ContactController::class, 'store']);
Route::post('/newsletter', [NewsletterController::class, 'subscribe']);

Route::get('/registration', function () {
    return view('registration');
});

Route::get('/terms-of-service', function () {
    return view('terms');
});

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});