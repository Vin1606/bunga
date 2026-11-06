<?php

use App\Http\Controllers\BouquetController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BouquetController::class, 'index'])->name('home');
