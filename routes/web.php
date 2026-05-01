<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ComicController;
use App\Http\Controllers\Frontend\ChapterController;
use App\Http\Controllers\Frontend\GenreController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\BookmarkController;
use App\Http\Controllers\Auth\AuthController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Comics
Route::get('/comics', [ComicController::class, 'index'])->name('comics.index');
Route::get('/comics/popular', [ComicController::class, 'popular'])->name('comics.popular');
Route::get('/comics/latest', [ComicController::class, 'latest'])->name('comics.latest');
Route::get('/comics/new', [ComicController::class, 'newReleases'])->name('comics.new');
Route::get('/comic/{slug}', [ComicController::class, 'show'])->name('comic.show');

// Chapters
Route::get('/comic/{comicSlug}/{chapterSlug}', [ChapterController::class, 'read'])
    ->name('chapter.read');

// Genres
Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
Route::get('/genre/{slug}', [GenreController::class, 'show'])->name('genre.show');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/api/search/suggest', [SearchController::class, 'suggest'])->name('search.suggest');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Bookmarks
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('user.bookmarks');
    Route::post('/bookmarks/{comicId}', [BookmarkController::class, 'toggle'])->name('bookmarks.toggle');

    // Admin Dashboard & Management
    Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        
        // Resource Management Routes (Stub for now)
        Route::resource('comics', \App\Http\Controllers\Admin\ComicController::class);
        Route::resource('chapters', \App\Http\Controllers\Admin\ChapterController::class);
        Route::resource('genres', \App\Http\Controllers\Admin\GenreController::class);
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    });
});
