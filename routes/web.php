<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;

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

Auth::routes(['verify' => true]);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'access-admin']], function() {
    Route::get('/{any}', 'AdminController@index')->where('any', '.*');
});

Route::group(['namespace' => 'Blog'], function() {
    Route::get('/', 'BlogPostController@index');
    Route::resource('/posts', 'BlogPostController', ['parameters' => ['posts' => 'slug'], 'only' => ['show']]);
    Route::resource('/categories', 'BlogCategoryController', ['parameters' => ['categories' => 'id'], 'only' => ['show']]);
    Route::resource('/support', 'SupportController', ['parameters' => ['support' => 'id']]);
    Route::post('/support/message/store', 'SupportController@storeMessage')->name('blog.support.message.store');
    Route::post('/posts/{slug}', 'BlogCommentController@store')->name('blog.comments.store');
    Route::get('/search', 'BlogSearchController@index')->name('blog.search.index');
    Route::get('/tags/{tags}', 'BlogSearchController@show')->name('blog.tags.show');
    Route::get('/pages/{slug}', 'PageController@show')->name('blog.pages.show');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth', 'access-admin']], function () {
    Lfm::routes();
});
