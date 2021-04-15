<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticlesController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $articles = Article::all();
        } else {
            $articles = Article::where('author_id', $user->id)->get();
        }

        return view('admin.articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }
}
