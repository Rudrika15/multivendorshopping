<?php

use App\Http\Controllers\Web\Admin\RoleController;
use App\Http\Controllers\Web\Admin\UserController;
//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route; // Use the correct namespace for Route

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});
