<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;

// Home
Route::get('/', [HomeController::class, 'index']);

// Praktikum 4 - DB Facade
Route::get('/level', [LevelController::class, 'index']);

// Praktikum 5 - Query Builder
Route::get('/kategori', [KategoriController::class, 'index']);

// Praktikum 6 - Eloquent ORM
Route::get('/user', [UserController::class, 'index']);

// Category Products dengan route prefix
Route::prefix('category')->group(function () {
    Route::get('/food-beverage', [CategoryController::class, 'foodBeverage']);
    Route::get('/beauty-health', [CategoryController::class, 'beautyHealth']);
    Route::get('/home-care', [CategoryController::class, 'homeCare']);
    Route::get('/baby-kid', [CategoryController::class, 'babyKid']);
});

// User dengan route parameter
Route::get('/user/{id}/name/{name}', [UserController::class, 'profile']);

// Sales
Route::get('/sales', [SalesController::class, 'index']);
