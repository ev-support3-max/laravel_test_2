<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

if (!Route::has('login')) {
    require __DIR__.'/auth.php';
}

// Route::get('/contact', [ContactController::class, 'index']);

// routes/api.php
Route::middleware(['auth:sanctum'])->get('/contact', function (Request $request) {
    return $request->json([
        'message' => 'Laravel API is working!',
    ]);
});

