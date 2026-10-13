
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/sach/{slug}', [BookController::class, 'show'])
    ->name('books.show');
