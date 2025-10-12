<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\BlogController;

Route::post('/contact', [ContactController::class, 'store']);
Route::post('/newsletter', [NewsletterController::class, 'subscribe']);
Route::get('/api/blog/posts', [BlogController::class, 'getLatestPosts']);
Route::get('/blog/search', [BlogController::class, 'search'])->name('blog.search');

Route::get('/registration', function () {
    return view('registration');
});

Route::get('/terms-of-service', function () {
    return view('terms');
});

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});