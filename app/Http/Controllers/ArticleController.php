<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\PopularArticleRequest;
use App\Http\Resources\ArticleReadResource;
use App\Http\Resources\ArticleResource;
use App\Models\Article;

class ArticleController extends Controller
{
    public function getPopular(PopularArticleRequest $request)
    {
        $resource = $request->getPopularArticles();
        return ArticleResource::collection($resource);
    }

    public function getRecent()
    {
        $resource = Article::latest()
            ->with(['author', 'category', 'creator', 'updater'])->paginate();
        return ArticleResource::collection($resource);
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->first();
        return ArticleReadResource::make($article)->resolve();
    }
}
