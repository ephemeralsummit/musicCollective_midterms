<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicPostController;


Route::get('/artists/{artist}', [ArtistController::class, 'show'])->name('artists.show');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('artists', [ArtistController::class, 'index'])->name('artists.index');
Route::get('/', [PublicPostController::class, 'index'])->name('home');
Route::get('/posts/{post}', [PublicPostController::class, 'show'])->name('posts.show');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('artists', ArtistController::class)->except(['show']);
    Route::resource('posts', PostController::class)->except(['show']);
});
require __DIR__.'/auth.php';
