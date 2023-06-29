<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductAssetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::get('/category/add', [CategoryController::class, 'create'])->name('category.add');
Route::post('/category/create', [CategoryController::class, 'store'])->name('category.create');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

// Produk
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/product/add', [ProductController::class, 'create'])->name('product.add');
Route::post('/product/create', [ProductController::class, 'store'])->name('product.create');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
Route::get('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

// Produk Asset
Route::post('/product-asset/add', [ProductAssetController::class, 'store'])->name('product-asset.create');
Route::get('/product-asset/destory/{id}', [ProductAssetController::class, 'destroy'])->name('product-asset.destroy');
