<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/getuser', 'AppController@getUser');

Auth::routes();

Route::post('/getposts', 'PostsController@getPosts');
Route::post('/getsinglepost/{postId}', 'PostsController@getSinglePost');
Route::post('/searchpost/{val}', 'PostsController@searchPost');

Route::group(['middleware' => ['auth']], function(){
    
    Route::group(['middleware' => ['admin']], function(){ 

        Route::resource('/post', 'PostsController');

    });
});


