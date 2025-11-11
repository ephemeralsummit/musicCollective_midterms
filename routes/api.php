<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ArtistController;

// Simple test route
Route::get('/ping', function() {
    return response()->json(['message' => 'API is working!']);
});

// Public endpoints
Route::get('/posts', [PostController::class, 'index']);       
Route::get('/posts/{post}', [PostController::class, 'show']); 
Route::get('/artists', [ArtistController::class, 'index']);   
Route::get('/artists/{artist}', [ArtistController::class, 'show']); 

// Protected endpoints (admin only)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);

    Route::post('/artists', [ArtistController::class, 'store']);
    Route::put('/artists/{artist}', [ArtistController::class, 'update']);
    Route::delete('/artists/{artist}', [ArtistController::class, 'destroy']);
});
