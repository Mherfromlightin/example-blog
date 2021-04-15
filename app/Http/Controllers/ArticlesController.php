<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function create()
    {
        $categories = Category::all('name', 'id')->toJson();

        return view('articles.create', compact('categories'));
    }

    public function store(CreateArticleRequest $request)
    {
        $photoName = null;

        if ($request->file('photo')) {
            $photoName = $request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs('public/articles', $photoName);
        }

        $article = Article::create([
            'name' => $request->name,
            'description' => $request->description,
            'author_id' => auth()->id(),
            'photo' => $photoName,
            'published_at' => Carbon::now(),
        ]);

        $article->categories()->sync($request->categories);

        return response()->json([
            'message' => 'Article created successfully!'
        ]);
    }

    public function show(Article $article, Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $article = $article->load([
                'comments',
                'comments.author',
                'categories',
                'author',
                'likes',
                'user_like'
            ]);

            return response()->json([
                'article' => $article,
            ]);
        }

        return view('articles.show', compact('article'));
    }

    public function search(Request $request)
    {
        $categoryId = $request->category_id;
        $categoryIds = Category::where('parent_category_id', $categoryId)->pluck('id')->toArray();
        $categoryIds[] = $categoryId;
        $articles = Article::whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('id', $categoryIds);
        })->with('categories', 'author')->get();

        return response()->json($articles);
    }
}
