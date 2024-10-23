<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\web\Vendor\CategoryController;
use App\Http\Controllers\Web\Admin\RoleController;
use App\Http\Controllers\Web\Admin\UserController;
use App\Http\Controllers\Web\Vendor\ProductController;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/Vendor.php';
require __DIR__ . '/Admin.php';

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');




// Route::group(['middleware' => ['auth']], function () {
//     Route::resource('roles', RoleController::class);
//     Route::resource('users', UserController::class);
//     Route::resource('products', ProductController::class);

//     Route::get('product/index', [ProductController::class, 'index'])->name('product.index');
//     Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
//     Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
//     Route::get('category', [CategoryController::class, 'index'])->name('category.index');
//     Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
//     Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
// });
