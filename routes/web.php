<?php

use App\Http\Controllers\PostController;
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

Auth::routes();

Route::get('@{username}', 'UserController@show');

Route::get('/search', 'HomeController@search');


Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('user/edit', 'UserController@edit');
    Route::put('user/edit', 'UserController@update');
    Route::resource('post', 'PostController');

    Route::get('/follow/{user_id}', 'UserController@follow');
    Route::get('/like/{post_id}', 'LikeController@toggle');

    //routing comment
    Route::post('comment/{post_id}', 'CommentController@store');
    Route::get('comment/{comment_id}/edit', 'CommentController@edit');
    Route::put('comment/{comment_id}', 'CommentController@update');
    Route::delete('comment/{comment_id}', 'CommentController@delete');
});
