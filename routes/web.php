<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/untuk-kamu', function () {
    return view('romantic');
});
