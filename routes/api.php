<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\SessionController;
use App\Http\Controllers\Api\EvenementController;
use App\Http\Controllers\Api\articles\UserController;
use App\Http\Controllers\Api\articles\MentorController;

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
//Pour les sessions 
Route::get('session', [SessionController::class, 'index']);
Route::post('session/create', [SessionController::class, 'store']);
Route::put('session/edit/{session}', [SessionController::class, 'update']);
Route::delete('session/{session}', [SessionController::class, 'destroy']);
Route::put('session/archive', [SessionController::class, 'archive']);
Route::get('session/sessionArchive', [SessionController::class, 'sessionArchive']);


//Pour les événements
Route::get('evenement', [EvenementController::class, 'index']);
Route::post('evenement/create', [EvenementController::class, 'store']);
Route::put('evenement/edit/{evenement}', [EvenementController::class, 'update']);
Route::delete('evenement/{evenement}', [EvenementController::class, 'destroy']);
Route::put('evenement/archive/{evenement}', [EvenementController::class, 'archive']);
Route::get('evenement/EvenementArchive', [EvenementController::class, 'EvenementArchive']);


//Pour les articles
Route::get('articles', [ArticleController::class, 'index']);
Route::put('articles/archives/{article}', [ArticleController::class, 'archive']);
Route::get('articlesArchives', [ArticleController::class, 'articlesArchives']);
Route::post('articles/create', [ArticleController::class, 'store']);
Route::put('articles/edit/{article}', [ArticleController::class, 'update']);
Route::delete('articles/{article}', [ArticleController::class, 'destroy']);


/*routes auth*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    dd(Auth::guard('mentor')->check());
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/mentor', function (Request $request) {
    return 'bnjr';
});

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);


Route::post('registerMentor', [MentorController::class, 'registerMentor']);

Route::post('login', [MentorController::class, 'login']);


Route::post('logout', [MentorController::class, 'logout']);


Route::middleware(['auth:sanctum', 'acces:mentor'])->group(function () {
    /*routes d'acces pour mentors*/
    
});

Route::middleware(['auth:sanctum', 'acces:user'])->group(function () {
    /*routes d'acces pour mentorés*/
    Route::post('logoutUser', [UserController::class, 'logoutUser']);

});

Route::middleware(['auth:sanctum', 'acces:admin'])->group(function () {
    /*routes d'acces pour admin*/
    /*routes de basse*/
 

});