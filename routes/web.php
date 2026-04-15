<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Thể loại
Route::get('caycanh/theloai/{id}', [HomeController::class, 'theloai']);
// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');
// xử lý tìm kiếm
Route::post('/timkiem', [HomeController::class, 'search']);

Route::get('/dashboard', function () {
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';


//Nhi
use App\Http\Controllers\Controller2;

// Route hiển thị trang chi tiết sản phẩm
Route::get('/chi-tiet/{id}', [Controller2::class, 'chitiet'])->name('caycanh.chitiet');

// Route xử lý thêm giỏ hàng (Phải dùng POST cho AJAX)
Route::post('/cart/add', [Controller2::class, 'addToCart'])->name('cart.add');