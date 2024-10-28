<?php

use App\Http\Controllers\Web\Admin\RoleController;
use App\Http\Controllers\Web\Admin\UserController;
use App\Http\Controllers\Web\Admin\StoreController;

//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route; // Use the correct namespace for Route

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::resource('stores', StoreController::class);
    Route::get('store/create', [StoreController::class, 'create'])->name('store.create');
    Route::post('store/store', [StoreController::class, 'store'])->name('store.store');






});
