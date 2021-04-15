<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $articles = Article::with('categories', 'author')->get();
        $allCategories = Category::all('name', 'id')->toJson();

        return view('welcome', compact('articles', 'allCategories'));
    }
}
