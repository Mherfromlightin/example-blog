<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Like;
use Illuminate\Http\Request;

class ArticleLikesController extends Controller
{
    public function syncLike(Article $article, Request $request)
    {
        $existingLike = Like::where('user_id', auth()->id())->where('article_id', $article->id)->first();

        if ($existingLike) {
            $existingLike->update([
                'like' => $request->like,
                'dislike' => $request->dislike,
            ]);

        } else {
            Like::create([
                'like' => $request->like,
                'dislike' => $request->dislike,
                'user_id' => auth()->id(),
                'article_id' => $article->id,
            ]);
        }

        return response()->noContent();
    }
}
