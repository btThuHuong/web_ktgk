<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);


Route::get('/dashboard', function () {
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/caycanh', [AdminController::class, 'plant_list'])->name('admin.plant.list');
    Route::get('/caycanh/create', [AdminController::class, 'plant_create'])->name('admin.plant.create');
    Route::post('/caycanh/save', [AdminController::class, 'plant_save'])->name('admin.plant.save');
    Route::post('/caycanh/delete/{id}', [AdminController::class, 'plant_delete'])->name('admin.plant.delete');
});