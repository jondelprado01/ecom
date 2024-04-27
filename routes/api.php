<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/category-add', [App\Http\Controllers\CategoryController::class, 'addCategory']);
Route::post('/category-edit/{id}', [App\Http\Controllers\CategoryController::class, 'editCategory']);
Route::delete('/category-delete/{id}', [App\Http\Controllers\CategoryController::class, 'deleteCategory']);


Route::post('/product-add', [App\Http\Controllers\ProductController::class, 'addProduct']);
Route::post('/product-edit/{id}', [App\Http\Controllers\ProductController::class, 'editProduct']);
Route::delete('/product-delete/{id}', [App\Http\Controllers\ProductController::class, 'deleteProduct']);

Route::post('/user-edit/{id}', [App\Http\Controllers\UserController::class, 'editUser']);
Route::delete('/user-delete/{id}', [App\Http\Controllers\UserController::class, 'deleteUser']);