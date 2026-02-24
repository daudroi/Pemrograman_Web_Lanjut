<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PhotoController;

// Praktikum 2 Step 6-7: Single Action Controllers
Route::get('/', [HomeController::class, 'index']);
Route::get('/hello', [WelcomeController::class, 'hello']);
Route::get('/world', function () {
    return 'World';
});
Route::get('/about', [AboutController::class, 'about']);

// Praktikum 1 Step 8-13: Route Parameters
Route::get('/user/{name}', function ($name) {
    return 'Nama saya ' . $name;
});

// Praktikum 1 Step 11-12: Multiple Parameters
Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    return 'Pos ke-' . $postId . " Komentar ke-: " . $commentId;
});

// Praktikum 1 Step 13: Articles Route (with ArticleController)
Route::get('/articles/{id}', [ArticleController::class, 'articles']);

// Praktikum 1 Step 14-16: Optional Parameters (dengan null default)
Route::get('/user/{name?}', function ($name = null) {
    return 'Nama saya ' . $name;
});

// Praktikum 1 Step 17-18: Optional Parameters (dengan default value 'John')
Route::get('/username/{name?}', function ($name = 'John') {
    return 'Nama saya ' . $name;
});

// Praktikum 1: Route Name, Group, Prefix, Redirect, View Routes
Route::get('/user/profile', function () {
    return 'Halaman Profile User';
})->name('profile');

// Praktikum 1: Redirect Routes
Route::redirect('/here', '/about');

// Praktikum 1: View Routes
Route::view('/welcome', 'welcome');

// Praktikum 2 Step 8-11: Resource Controller
Route::resource('photos', PhotoController::class);

// Praktikum 3 Step 2-3: View Routes dengan data
// Praktikum 3 Step 9-10: View dari Controller
Route::get('/greeting', [WelcomeController::class, 'greeting']);
