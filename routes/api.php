<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('dashboard', [HomeController::class, 'index']);
Route::apiResources([
    'articles' => ArticleController::class,
    'categories' => CategoryController::class,
    'authors' => AuthorController::class,
    'sliders' => SliderController::class,
]);
Route::get('popular-articles', [ArticleController::class, 'getPopular']);
Route::get('recent-articles', [ArticleController::class, 'getRecent']);
Route::get('categories/{category}/articles', [CategoryController::class, 'getArticles']);
Route::get('categories-with-articles', [CategoryController::class, 'getWithArticles']);
Route::get('stream/{file}', [FileController::class, 'show'])
    ->where('file', '.*')->name('files.show');
Route::post('files', [FileController::class, 'store'])->middleware('auth:sanctum');
