<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::get('products/delete/{product}', [ProductController::class, 'delete'])->name('products.delete');
Route::resource('products', ProductController::class)->except(['destroy']);

