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
});
