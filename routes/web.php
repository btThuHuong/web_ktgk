<?php

use Illuminate\Support\Facades\Route;

// Gom tất cả các thư viện Controllers lên đầu cho chuẩn
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller2;
use App\Http\Controllers\Controller3;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('caycanh/theloai/{id}', [HomeController::class, 'theloai']);
Route::post('/timkiem', [HomeController::class, 'search']);


Route::get('/chi-tiet/{id}', [Controller2::class, 'chitiet'])->name('caycanh.chitiet');
Route::post('/cart/add', [Controller2::class, 'addToCart'])->name('cart.add'); // Xử lý AJAX thêm giỏ hàng


Route::get('/gio-hang', [Controller3::class, 'giohang'])->name('cart.show');
Route::get('/gio-hang/xoa/{id}', [Controller3::class, 'remove'])->name('cart.remove');
Route::post('/cart/checkout', [Controller3::class, 'checkout'])->name('cart.checkout');



Route::middleware('auth')->group(function () {
    Route::get('/caycanh', [AdminController::class, 'plant_list'])->name('admin.plant.list');
    Route::get('/caycanh/create', [AdminController::class, 'plant_create'])->name('admin.plant.create');
    Route::post('/caycanh/save', [AdminController::class, 'plant_save'])->name('admin.plant.save');
    Route::post('/caycanh/delete/{id}', [AdminController::class, 'plant_delete'])->name('admin.plant.delete');
});


Route::get('/dashboard', function () {
    // return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';