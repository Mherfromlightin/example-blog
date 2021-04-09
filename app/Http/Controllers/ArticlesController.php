<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

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

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id');

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

        $article->categories()->attach($request->category_id);

        Session::flash('success_message', 'Article created successfully!');

        return redirect('/');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }
}
