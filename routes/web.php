<?php

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

use App\Http\Controllers\Blog\PostsController;

Route::get('/','WelcomeController@index')->name('welcome');
Route::get('/blog/posts/{post}',[PostsController::class,'show'])->name('blog.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/categories','CategoriesController');
Route::resource('/posts','PostsController');
Route::resource('/tags','TagsController');
Route::get('trashed-posts','PostsController@trashed')->name('trashed-posts.index');
Route::put('restore-post/{post}','PostsController@restore')->name('restore-posts');
Route::get('users','UsersController@index')->name('users-index');
Route::post('users/{user}/make-admin','UsersController@makeadmin')->name('users.make-admin');
Route::get('users/profile','UsersController@edit')->name('users.edit-profile');
Route::put('route/profile','UsersController@update')->name('route.update-profile');

//Route::get('/categories/new', 'CategoriesController@index');
//Route::post('/categories/create', 'CategoriesController@store');
//
//Route::get('/categories/{categories}/edit', 'CategoriesController@edit');
//Route::post('/categories/{categories}/update', 'CategoriesController@update');
//Route::get('/categories/{categories}/delete', 'CategoriesController@destroy');
