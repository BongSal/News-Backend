<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\CategoryArticleResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $resource = Category::orderBy('order')->get();
        return CategoryResource::collection($resource);
    }

    public function getWithArticles()
    {
        $resource = Category::orderBy('order')
            ->with(['articles' => fn ($qb) => $qb->take(4)->latest()])->get();
        return CategoryArticleResource::collection($resource);
    }

    public function getArticles(Category $category)
    {
        $resource = $category->articles()->latest()->paginate();
        return ArticleResource::collection($resource);
    }
}
