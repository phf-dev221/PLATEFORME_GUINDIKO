<?php

use App\Http\Controllers\Api\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Pour les articles
Route::get('articles', [ArticleController::class, 'index']);
Route::put('articles/archives/{article}', [ArticleController::class, 'archive']);
Route::get('articlesArchives', [ArticleController::class, 'articlesArchives']);
Route::post('articles/create', [ArticleController::class, 'store']);
Route::put('articles/edit/{article}', [ArticleController::class, 'update']);
Route::delete('articles/{article}', [ArticleController::class, 'destroy']);
