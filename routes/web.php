<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Thể loại
Route::get('caycanh/theloai/{id}', [HomeController::class, 'theloai']);
// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';
