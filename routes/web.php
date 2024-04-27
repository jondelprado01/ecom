<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
    Route::get('/product-categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('product-categories');
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');

});