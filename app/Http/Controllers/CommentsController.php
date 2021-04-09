<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Article;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function index(Article $article)
    {
        return view('comments.index', compact('article'));
    }

    public function store(CreateCommentRequest $request)
    {
        Comment::create([
            'body' => $request->body,
            'article_id' => $request->article_id,
            'author_id' => $request->author_id,
        ]);

        return redirect()->back();
    }
}
