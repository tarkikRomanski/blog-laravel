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

Route::get('storage/{filename}', function ($filename)
{
    return \App\Classes\Facades\Uploader::getUploadFile($filename);
});

Route::get('/', 'CategoryController@index')->name('categories');
Route::get('/categories/create', 'CategoryController@create')->name('categories.create');
Route::get('/categories/update/{id}', 'CategoryController@update')->name('categories.update');
Route::get('/categories/get/{id}', 'CategoryController@get')->name('categories.get');

Route::get('/posts/get/{id}', 'PostController@get')->name('posts.get');