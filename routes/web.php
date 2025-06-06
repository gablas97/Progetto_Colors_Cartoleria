<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

// Homepage
Route::get('/', [PublicController::class, 'homepage'])->name('homepage');

// Prodotti
Route::get('/prodotti', [ProductController::class, 'index'])->name('products.index');
Route::get('/prodotto/{product:slug}', [ProductController::class, 'show'])->name('products.show');

// Categorie
Route::get('/categoria/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

// Carrello (per ora solo visualizzazione)
Route::get('/carrello', [CartController::class, 'index'])->name('cart.index');