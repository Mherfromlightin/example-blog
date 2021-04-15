<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Article;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function store(Article $article, CreateCommentRequest $request)
    {
        Comment::create([
            'body' => $request->body,
            'article_id' => $article->id,
            'author_id' => auth()->id(),
        ]);

        return response()->noContent();
    }
}
