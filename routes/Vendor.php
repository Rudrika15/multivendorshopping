<?php

use App\Http\Controllers\Web\Vendor\ProductController;
use App\Http\Controllers\Web\Vendor\CategoryController;
use App\Http\Controllers\Web\Vendor\StoreController;
use App\Http\Controllers\Web\Vendor\AttributeController;
use App\Http\Controllers\Web\Vendor\AttributeValueController;
use App\Http\Controllers\Web\Vendor\OrderMasterController;



use App\Http\Controllers\Web\Vendor\ProductVariantController;
use App\Http\Controllers\Web\Vendor\ReviewController;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\OrderMaster;
use App\Models\Product;
use App\Models\ProductVariant;
//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route; // Use the correct namespace for Route



Route::group(['prefix' => 'vendor', 'middleware' => ['auth']], function () {

    Route::get('store/profile', [StoreController::class, 'profile'])->name('store.profile');

    Route::post('update/profile', [StoreController::class, 'updateProfile'])->name('update.profile');


    Route::resource('products', ProductController::class);
    Route::get('product/index', [ProductController::class, 'index'])->name('product.index');
    Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('product/edit/{id?}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('product/update/{id?}',[ProductController::class,'update'] )->name('product.update');
    Route::post('product/delete/{id?}', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::get('category/index', [CategoryController::class, 'index'])->name('category.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::post('category/delete/{id?}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('category/edit/{id?}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/update',[CategoryController::class,'update'] )->name('category.update');



    Route::get('productVariant/index', [ProductVariantController::class, 'index'])->name('productVariant.index');
    Route::get('productVariant/create', [ProductVariantController::class, 'create'])->name('productVariant.create');
    Route::post('productVariant/store', [ProductVariantController::class, 'store'])->name('productVariant.store');
    Route::post('productVariant/delete/{id?}', [ProductVariantController::class, 'destroy'])->name('productVariant.destroy');
    Route::get('productVariant/edit/{id?}', [ProductVariantController::class, 'edit'])->name('productVariant.edit');
    Route::post('productVariant/update/{id?}',[ProductVariantController::class,'update'] )->name('productVariant.update');


    Route::get('attribute/index', [AttributeController::class, 'index'])->name('attribute.index');
    Route::get('attribute/create', [AttributeController::class, 'create'])->name('attribute.create');
    Route::post('attribute/store', [AttributeController::class, 'store'])->name('attribute.store');
    Route::post('attribute/delete/{id?}', [AttributeController::class, 'destroy'])->name('attribute.destroy');
    Route::get('attribute/edit/{id?}', [AttributeController::class, 'edit'])->name('attribute.edit');
    Route::post('attribute/update/{id?}',[AttributeController::class,'update'] )->name('attribute.update');



    Route::get('attributeValue/index', [AttributeValueController::class, 'index'])->name('attributeValue.index');
    Route::get('attributeValue/create', [AttributeValueController::class, 'create'])->name('attributeValue.create');
    Route::post('attributeValue/store', [AttributeValueController::class, 'store'])->name('attributeValue.store');
    Route::post('attributeValue/delete/{id?}', [AttributeValueController::class, 'destroy'])->name('attributeValue.destroy');
    Route::get('attributeValue/edit/{id?}', [AttributeValueController::class, 'edit'])->name('attributeValue.edit');
    Route::post('attributeValue/update/{id?}',[AttributeValueController::class,'update'] )->name('attributeValue.update');




    Route::get('review/index', [ReviewController::class, 'index'])->name('review.index');


    Route::get('order/index', [OrderMasterController::class, 'index'])->name('order.index');

});
