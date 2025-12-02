<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicMarketController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('market.index');
Route::get('/p/{slug}', [App\Http\Controllers\HomeController::class, 'show'])->name('products.show');
Route::get('/product/{slug}', [PublicMarketController::class, 'show'])->name('market.show');
Route::get('/tienda/{vendor:slug}', [App\Http\Controllers\PublicVendorController::class, 'show'])->name('vendor.show');
Route::get('/terminos', [App\Http\Controllers\PageController::class, 'terms'])->name('pages.terms');
Route::get('/privacidad', [App\Http\Controllers\PageController::class, 'privacy'])->name('pages.privacy');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if (!$user->vendor) {
            return view('dashboard', ['hasVendor' => false]);
        }
        return view('dashboard', ['hasVendor' => true, 'products' => $user->vendor->products]);
    })->name('dashboard');

    Route::post('/vendor/create', [App\Http\Controllers\VendorController::class, 'store'])->name('vendor.store');
    Route::get('/vendor/products/create', [App\Http\Controllers\VendorProductController::class, 'create'])->name('vendor.products.create');
    Route::post('/vendor/products', [App\Http\Controllers\VendorProductController::class, 'store'])->name('vendor.products.store');
    Route::get('/vendor/products/{product}/edit', [App\Http\Controllers\VendorProductController::class, 'edit'])->name('vendor.products.edit');
    Route::put('/vendor/products/{product}', [App\Http\Controllers\VendorProductController::class, 'update'])->name('vendor.products.update');
    Route::delete('/vendor/products/{product}', [App\Http\Controllers\VendorProductController::class, 'destroy'])->name('vendor.products.destroy');

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
