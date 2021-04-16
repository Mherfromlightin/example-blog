<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ArticleLikesController;
use App\Http\Controllers\CommentsController;
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
    Route::post('/articles/{article}/comments', [CommentsController::class, 'store'])->name('comments.store');
    Route::post('/articles/{article}/likes', [ArticleLikesController::class, 'syncLike']);

    Route::get('/articles/create', [ArticlesController::class, 'create'])->name('articles.create');
    Route::get('/articles/search', [ArticlesController::class, 'search'])->name('articles.search');
    Route::get('/articles/{article}', [ArticlesController::class, 'show'])->name('articles.show');
    Route::get('/articles', [ArticlesController::class, 'index'])->name('articles.index');
    Route::post('/articles', [ArticlesController::class, 'store'])->name('articles.store');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
