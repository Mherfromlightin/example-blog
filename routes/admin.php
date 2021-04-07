<?php

use App\Http\Controllers\Admin\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => '/admin'], function () {
    Route::get('/categories', [CategoriesController::class, 'index'])->name('admin.categories.index');
});