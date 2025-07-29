<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//select all
Route::get('article',[ArticleController::class , 'index']);

//select one
Route::get('article/{article}', [ArticleController::class , 'show']);

//create one by post method 
Route::post('article',[ArticleController::class , 'store']);

//update one post
Route::put('article/{article}',[ArticleController::class , 'update']);

//delete one post
Route::delete('article/{article}',[ArticleController::class , 'destroy']);
