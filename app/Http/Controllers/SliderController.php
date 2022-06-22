<?php

namespace App\Http\Controllers;

use App\Http\Resources\SliderResource;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index()
    {
        $resource = Slider::with('article')->orderBy('order')->take(5)->get();
        return SliderResource::collection($resource);
    }
}
