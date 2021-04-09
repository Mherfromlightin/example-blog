<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\ArticlesController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => '/admin'], function () {
    Route::get('/categories', [CategoriesController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [CategoriesController::class, 'store'])->name('admin.categories.store');

    Route::get('/articles', [ArticlesController::class, 'index'])->name('admin.articles.index');

});