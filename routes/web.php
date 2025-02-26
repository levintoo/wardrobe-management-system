<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::inertia('/dashboard', 'Dashboard')
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
});

Route::get('/', function () {
    return redirect(route('dashboard'));
});

Route::middleware('auth')
    ->controller(ProfileController::class)
    ->group(function () {
    Route::get('/profile', 'edit')->name('profile.edit');
    Route::patch('/profile', 'update')->name('profile.update');
    Route::delete('/profile', 'destroy')->name('profile.destroy');
});

require __DIR__.'/auth.php';
