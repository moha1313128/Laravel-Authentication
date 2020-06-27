<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Api routes with jwt
// Route::post('user/register', 'AuthController@register');
// Route::post('user/login', 'AuthController@login');

// Route::middleware('jwt.auth')->get('/users', function (Request $request) {
//     return auth()->user();
// });
// Route::middleware('jwt.auth')->group(function() {
//     Route::resource('/books', 'BookController');
// });

// Api routes with passport
Route::post('register', 'AuthController@register');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return auth()->user();
});

Route::middleware('auth:api')->group(function() {
    Route::resource('/books', 'BookController');
});