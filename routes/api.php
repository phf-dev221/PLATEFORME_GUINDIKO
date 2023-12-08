<?php

use App\Http\Controllers\Api\EvenementController;
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
//Pour les événements
Route::get('evenement', [EvenementController::class, 'index']);
Route::post('evenement/create', [EvenementController::class, 'store']);
Route::put('evenement/edit/{evenement}', [EvenementController::class, 'update']);
Route::delete('evenement/{evenement}', [EvenementController::class, 'destroy']);
Route::put('evenement/archive/{evenement}', [EvenementController::class, 'archive']);
Route::get('evenement/EvenementArchive', [EvenementController::class, 'EvenementArchive']);

