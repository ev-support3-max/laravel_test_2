<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

// ログインページ
Route::get('/login', function () {
    return redirect()->route('filament.admin.auth.login');
})->name('login');

// home
Route::get('/', function () {
    return view('home.index');
});

// お問い合わせフォーム（contact)
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index'); // ただの飛び先
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store'); // 保存先