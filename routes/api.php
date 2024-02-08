<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\MoviesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/test', function(){
    echo 'hello world';
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// GET VISITOR DETAIL
Route::get('/getvisitor', [VisitorController::class, 'GetVisitorDetails']);   //->name('visito.index');

// POST CONTACT PAGE ROUTE
Route::post('/postcontact', [ContactController::class, 'PostContactDetails']);   //->name('visito.index');

// Define a route for a GET request
Route::get('/getmovies', [MoviesController::class, 'getMovies']);

// Define a route for a POST request
Route::get('/tvseries', [MoviesController::class, 'tvSeries']);

Route::get('/searchmovies', [MoviesController::class, 'searchMovies']);


Route::post('/getstarted', [FormController::class, 'GetStarted']);

Route::post('/signup', [FormController::class, 'SignUp']);

Route::post('/login', [FormController::class, 'signIn']);

Route::post('/forgot-password', [FormController::class, 'forgotPassword']);

Route::post('/reset-password', [FormController::class, 'resetPassword']);
