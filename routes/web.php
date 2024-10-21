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
