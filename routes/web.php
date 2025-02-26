<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClothingItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)
        ->name('dashboard');

    Route::controller(CategoryController::class)
        ->group(function () {
            Route::get('/categories', 'index')->name('category.index');
            Route::get('/category/create', 'create')->name('category.create');
            Route::post('/category/create', 'store')->name('category.store');
            Route::delete('/category/{category}', 'destroy')->name('category.delete');
            Route::get('/category/{category}', 'show')->name('category.edit');
            Route::patch('/category/{category}', 'update')->name('category.update');
        });

    Route::controller(ClothingItemController::class)
        ->group(function () {
            Route::get('/clothing', 'index')->name('clothing.index');
            Route::get('/clothing/create', 'create')->name('clothing.create');
            Route::post('/clothing/create', 'store')->name('clothing.store');
            Route::delete('/clothing/{clothingItem}', 'destroy')->name('clothing.delete');
            Route::get('/clothing/{clothingItem}', 'show')->name('clothing.edit');
            Route::post('/clothing/{clothingItem}', 'update')->name('clothing.update');
        });

    Route::controller(ProfileController::class)
        ->group(function () {
            Route::get('/profile', 'edit')->name('profile.edit');
            Route::patch('/profile', 'update')->name('profile.update');
            Route::delete('/profile', 'destroy')->name('profile.destroy');
        });
});

Route::get('/', function () {
    return redirect()->route('dashboard');
});

require __DIR__.'/auth.php';
