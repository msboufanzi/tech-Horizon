<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\PublicArticleController;



Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/',function () {
//     return view('home');
// })->name('home');

Route::get('/editor_dashboard', function () {
    return view('editor_dashboard');
})->name('editor_dashboard');

Route::get('/theme_manager_dashboard', function () {
    return view('theme_manager_dashboard');
})->name('theme_manager_dashboard');

Route::get('/subscriber_dashboard', function () {
    return view('subscriber_dashboard');
})->name('subscriber_dashboard');

Route::get('/themes', [ThemeController::class, 'index'])->name('themes');

Route::get('/public-articles', [PublicArticleController::class, 'index'])->name('public.articles');

Route::get('/articles', function () {
    return view('articles');
})->name('articles');

Route::get('/article_details', function () {
    return view('article_details');
})->name('article_details');

// Auth routes
Route::get('/auth', [AuthController::class, 'showAuthForm'])->name('auth');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



