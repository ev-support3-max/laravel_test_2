<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactController;


// API接続チェック用
Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

// contact接続用
Route::post('/contact', [ContactController::class, 'store']);