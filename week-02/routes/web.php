<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Selamat Datang');
});

Route::get('/hello', function () {
return 'Hello World';
});

Route::get('/world', function () {
return 'World';
});

Route::get('/about', function () {
return 'Nama : Achmad Daud Roichan <br> NIM : 244107020005 <br> Kelas : TI-2F';
});




