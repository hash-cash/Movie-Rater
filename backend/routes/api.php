<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MoviesController;
use App\Http\Controllers\TimeslotsController;
use App\Http\Controllers\PerformersController;
use App\Http\Controllers\PerformersMoviesController;
use App\Http\Controllers\RatingsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/movies', [MoviesController::class, 'index']);
Route::get('/movies/sort/hr', [MoviesController::class, 'highestRated']);
Route::get('/movies/sort/mv', [MoviesController::class, 'mostViewed']);
Route::get('/movies/sort/da', [MoviesController::class, 'dateAdded']);
Route::get('/movies/search/{search}', [MoviesController::class, 'search']);
Route::get('/movies/{id}', [MoviesController::class, 'show']);
Route::post('/movies', [MoviesController::class, 'store']);
Route::put('/movies/{id}', [MoviesController::class, 'update']);
Route::delete('/movies/{id}', [MoviesController::class, 'delete']);

Route::get('/ratings', [RatingsController::class, 'index']);
Route::get('/ratings/{id}', [RatingsController::class, 'show']);
Route::get('/ratings/count/{id}', [RatingsController::class, 'getCount']);
Route::get('/ratings/search/username', [RatingsController::class, 'searchUsername']);
Route::get('/ratings/search/movie/{id}', [RatingsController::class, 'searchMovie']);
Route::post('/ratings', [RatingsController::class, 'store']);
Route::put('/ratings/{id}', [RatingsController::class, 'update']);
Route::delete('/ratings/{id}', [RatingsController::class, 'delete']);
