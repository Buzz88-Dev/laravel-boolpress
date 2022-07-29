<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/posts','Api\PostController@index')->name('api.posts.index'); //le uniche due rotte che vogliamo sono la index e lo show
// in realta scriviamo /posts ma nella route è come se scrivessi: http://127.0.0.1:8000/api/posts
// le view non ci sono perche è un api e quindi mi ritorna json
