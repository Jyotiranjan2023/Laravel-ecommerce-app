<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::middleware(['auth'])->group(function () {

    Route::resource('products', ProductController::class);

    Route::post('/cart/add/{id}', [CartController::class, 'add']);
    Route::get('/cart', [CartController::class, 'index']);

    Route::get('/cart/increase/{id}', [CartController::class, 'increase']);
Route::get('/cart/decrease/{id}', [CartController::class, 'decrease']);
Route::get('/cart/remove/{id}', [CartController::class, 'remove']);

Route::post('/cart/remove/{id}', [CartController::class, 'remove']);
Route::post('/cart/checkout', [CartController::class, 'checkout']);

Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';