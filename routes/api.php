<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::apiResources([
    'articles' => ArticleController::class,
    'categories' => CategoryController::class,
    'authors' => AuthorController::class,
    'sliders' => SliderController::class,
]);
Route::get('stream/{file}', [FileController::class, 'show'])
    ->where('file', '.*')->name('files.show');
Route::post('files', [FileController::class, 'store'])->middleware('auth:sanctum');
