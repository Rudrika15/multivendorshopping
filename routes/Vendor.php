<?php

use App\Http\Controllers\Web\Vendor\ProductController;
use App\Http\Controllers\web\Vendor\CategoryController;
//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route; // Use the correct namespace for Route



Route::group(['prefix' => 'vendor', 'middleware' => ['auth']], function () {
    Route::resource('products', ProductController::class);
    Route::get('product/index', [ProductController::class, 'index'])->name('product.index');
    Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('product/store', [ProductController::class, 'store'])->name('product.store');

    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
});
