<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        $fromDate = now()->subMonth()->format('Y-m-d H:i:s');
        $toDate = now()->format('Y-m-d H:i:s');
        $sliders = Slider::with('article')->orderBy('order')->take(5)->get();
        $categories = Category::orderBy('order')->with(['articles' => fn ($qb) => $qb->take(4)->latest()])->get();
        $popular_monthly = Article::latest('total_views')->whereBetween('created_at', [$fromDate, $toDate])->take(4)->get();
        $new_articles = Article::latest()->take(4)->get();
        return response()->json(compact('sliders', 'categories', 'popular_monthly', 'new_articles'));
    }
}
