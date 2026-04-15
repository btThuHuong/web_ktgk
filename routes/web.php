<?php

use App\Http\Controllers\AdminController;
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


use App\Http\Controllers\Controller2;

// Route hiển thị trang chi tiết sản phẩm
Route::get('/chi-tiet/{id}', [Controller2::class, 'chitiet'])->name('caycanh.chitiet');

// Route xử lý thêm giỏ hàng (Phải dùng POST cho AJAX)
Route::post('/cart/add', [Controller2::class, 'addToCart'])->name('cart.add');


use App\Http\Controllers\Controller03;
// Đường dẫn hiển thị trang giỏ hàng 
Route::get('/gio-hang', [Controller03::class, 'index'])->name('cart.index');

// Đường dẫn thêm sản phẩm vào giỏ (Dùng cho AJAX trong file chitiet.blade.php)
Route::post('/gio-hang/them', [Controller03::class, 'add'])->name('cart.add');

// Đường dẫn xóa sản phẩm
Route::get('/gio-hang/xoa/{id}', [Controller03::class, 'remove'])->name('cart.remove');

// Đường dẫn xử lý đặt hàng

use App\Http\Controllers\Controller3;

// Nhóm các Route dành cho Controller3 (Quản lý giỏ hàng & Đặt hàng)
Route::get('/gio-hang', [Controller3::class, 'giohang'])->name('cart.show');
Route::get('/cart/remove/{id}', [Controller3::class, 'removeCart'])->name('cart.remove');
Route::post('/cart/checkout', [Controller3::class, 'checkout'])->name('cart.checkout');
=======
//Loc
Route::middleware('auth')->group(function () {
    Route::get('/caycanh', [AdminController::class, 'plant_list'])->name('admin.plant.list');
    Route::get('/caycanh/create', [AdminController::class, 'plant_create'])->name('admin.plant.create');
    Route::post('/caycanh/save', [AdminController::class, 'plant_save'])->name('admin.plant.save');
    Route::post('/caycanh/delete/{id}', [AdminController::class, 'plant_delete'])->name('admin.plant.delete');
});

