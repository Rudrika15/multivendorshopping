<?php

use App\Http\Controllers\Web\Vendor\ProductController;
use App\Http\Controllers\web\Vendor\CategoryController;
use App\Http\Controllers\Web\Vendor\StoreController;
use App\Http\Controllers\Web\Vendor\AttributeController;
use App\Http\Controllers\Web\Vendor\AttributeValueController;


use App\Http\Controllers\Web\Vendor\ProductVariantController;

//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route; // Use the correct namespace for Route



Route::group(['prefix' => 'vendor', 'middleware' => ['auth']], function () {

    Route::get('store/profile', [StoreController::class, 'profile'])->name('store.profile');
    Route::get('store/create', [StoreController::class, 'create'])->name('store.create');

    Route::post('update/profile', [StoreController::class, 'updateProfile'])->name('update.profile');


    Route::resource('products', ProductController::class);
    Route::get('product/index', [ProductController::class, 'index'])->name('product.index');
    Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
    Route::delete('product/delete', [ProductController::class, 'store'])->name('product.destroy');

    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');

    Route::get('productVariant/index', [ProductVariantController::class, 'index'])->name('productVariant.index');
    Route::get('productVariant/create', [ProductVariantController::class, 'create'])->name('productVariant.create');
    Route::post('productVariant/store', [ProductVariantController::class, 'store'])->name('productVariant.store');

    Route::get('attribute/index', [AttributeController::class, 'index'])->name('attribute.index');
    Route::get('attribute/create', [AttributeController::class, 'create'])->name('attribute.create');
    Route::post('attribute/store',[AttributeController::class,'store'])->name('attribute.store');


    Route::get('attributeValue/index', [AttributeValueController::class, 'index'])->name('attributeValue.index');
    Route::get('attributeValue/create', [AttributeValueController::class, 'create'])->name('attributeValue.create');
    Route::post('attributeValue/store',[AttributeValueController::class,'store'])->name('attributeValue.store');


});
