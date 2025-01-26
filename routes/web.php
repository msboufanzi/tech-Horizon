<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\PublicArticleController;
use App\Http\Controllers\GuestArticleController;
use App\Http\Controllers\ArticlesController;



Route::get('/', [HomeController::class, 'index'])->name('home');


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

Route::get('/articles', [ArticlesController::class, 'index'])->name('articles');

Route::get('/articles/theme/{themeId}', [ArticlesController::class, 'showByTheme'])->name('articles.byTheme');

Route::get('/article/{id}', [ArticlesController::class, 'show'])->name('article_details');

Route::get('/guest-article/{article_id}', [GuestArticleController::class, 'show'])->name('guest_article_details');


// Auth routes
Route::get('/auth', [AuthController::class, 'showAuthForm'])->name('auth');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



