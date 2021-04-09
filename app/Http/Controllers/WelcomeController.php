<?php

namespace App\Http\Controllers;

use App\Models\Article;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $articles = Article::with('categories')->get();

        return view('welcome', compact('articles'));
    }
}
