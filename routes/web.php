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
Route::post('/getusername{userId}', 'AppController@getUserName');

Auth::routes();

Route::post('/getposts', 'PostsController@getPosts');
Route::post('/getsinglepost/{postId}', 'PostsController@getSinglePost');
Route::post('/searchpost/{val}', 'PostsController@searchPost');
Route::post('/searchcat/{val}', 'PostsController@searchCat');
Route::post('/getlikedusers/{val}', 'PostsController@getLikedUsers');

Route::group(['middleware' => ['auth']], function(){
    
    Route::post('/post/like/{postId}', 'PostsController@like');
    Route::post('/comment/get', 'CommentsController@index');
    Route::post('/comment/create/{postId}', 'CommentsController@store');

    Route::group(['middleware' => ['owner']], function(){

        Route::post('/comment/delete/{commentId}/{userId}', 'CommentsController@destroy');
        Route::post('/authedit/{userId}', 'AppController@updateUser');

    });

    Route::group(['middleware' => ['admin']], function(){ 

        Route::resource('/post', 'PostsController');

    });
});


