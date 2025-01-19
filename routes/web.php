<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/themes', function () {
    return view('themes');
})->name('themes');

Route::get('/public-articles', function () {
    return view('public_articles');
})->name('public.articles');

Route::get('/articles', function () {
    return view('articles');
})->name('articles');

// Auth routes
Route::get('/auth', [AuthController::class, 'showAuthForm'])->name('auth');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

