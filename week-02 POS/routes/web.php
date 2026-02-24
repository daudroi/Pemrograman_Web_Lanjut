<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;

// Home
Route::get('/', [HomeController::class, 'index']);

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
