<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/health', function() {
    return response()->json(['status' => 'ok']);
});

Route::post('/contact', [ContactController::class, 'store']);

Route::get('/user-test', function () {
    return response()->json([
        'id' => 1,
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);
});