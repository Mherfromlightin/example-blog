<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', WelcomeController::class);

Route::group(['middleware' => ['auth']], function () {

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/articles', [ArticlesController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticlesController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticlesController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}', [ArticlesController::class, 'show'])->name('articles.show');


    Route::get('/articles/{article}/comments', [CommentsController::class, 'index'])->name('comments.index');
    Route::post('/comments', [CommentsController::class, 'store'])->name('comments.store');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
