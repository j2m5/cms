<?php

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

Route::group(['prefix' => '/admin', 'namespace' => 'Admin', 'middleware' => ['auth:api']], function() {
    Route::get('/site-url', 'AdminController@getSiteUrl');
    Route::get('/site-name', 'AdminController@getSiteName');
    Route::get('/site-logo', 'AdminController@getSiteLogo');
    Route::get('/auth-user', 'AdminController@getAuthUser');
});

Route::group(['prefix' => '/admin', 'namespace' => 'Api\Admin', 'middleware' => ['auth:api']], function() {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/dashboard/users', 'DashboardController@users')->name('dashboard.users');
    Route::get('/dashboard/comments', 'DashboardController@comments')->name('dashboard.comments');
    Route::get('/dashboard/years', 'DashboardController@getSiteExistingYears')->name('dashboard.years');
    Route::resource('/categories', 'BlogCategoryController', ['parameters' => ['categories' => 'id'], 'except' => ['show']]);
    Route::resource('/comments', 'BlogCommentController', ['parameters' => ['comments' => 'id'], 'only' => ['index', 'edit', 'update', 'destroy']]);
    Route::resource('/posts', 'BlogPostController', ['parameters' => ['posts' => 'id'], 'except' => ['show']]);
    Route::resource('/tags', 'TagController', ['parameters' => ['tags' => 'id']]);
    Route::resource('/users', 'UserController', ['parameters' => ['users' => 'id'], 'except' => ['show']]);
    Route::resource('/tickets', 'TicketController', ['parameters' => ['tickets' => 'id'], 'only' => ['index', 'show']]);
    Route::resource('/pages', 'PageController', ['parameters' => ['pages' => 'id'], 'except' => ['create', 'show']]);
    Route::resource('/menus', 'MenuController', ['parameters' => ['menus' => 'id'], 'except' => ['show']]);
    Route::resource('/menu-items', 'MenuItemController', ['parameters' => ['menu-items' => 'id'], 'except' => ['show']]);
    Route::post('/tickets/message/store', 'TicketController@storeMessage')->name('admin.tickets.message.store');
    Route::patch('/tickets/{id}/close', 'TicketController@closeTicket')->name('admin.tickets.close');
    Route::get('/tickets/counters', 'TicketController@getProcessingTicketsAndUnreadMessages')->name('admin.tickets.counters');
    Route::get('/events', 'EventController@index')->name('admin.events.index');
    Route::get('/trash', 'TrashController@index')->name('trash.index');
    Route::post('/categories/{id}/restore', 'BlogCategoryController@restore')->name('categories.restore');
    Route::post('/posts/{id}/restore', 'BlogPostController@restore')->name('posts.restore');
    Route::post('/pages/{id}/restore', 'PageController@restore')->name('pages.restore');
    Route::post('/comments/{id}/restore', 'BlogCommentController@restore')->name('comments.restore');
    Route::delete('/categories/{id}/erase', 'BlogCategoryController@forceDelete')->name('categories.erase');
    Route::delete('/posts/{id}/erase', 'BlogPostController@forceDelete')->name('posts.erase');
    Route::delete('/pages/{id}/erase', 'PageController@forceDelete')->name('pages.erase');
    Route::delete('/comments/{id}/erase', 'BlogCommentController@forceDelete')->name('comments.erase');
    Route::post('/tools/site-map-generate', 'ToolController@siteMapGenerate')->name('admin.sitemap.generate');
    Route::post('/tools/sym-link-generate', 'ToolController@symLinkGenerate')->name('admin.symlink.generate');
    Route::get('/themes', 'SettingController@themes')->name('settings.themes');
    Route::patch('/themes/{id}', 'SettingController@updateTheme')->name('settings.update.theme');
    Route::get('/settings', 'SettingController@index')->name('settings.index');
    Route::patch('/settings/{id}', 'SettingController@updateSiteSettings')->name('settings.update.settings');
    Route::patch('/users/{id}/ban', 'UserController@ban')->name('admin.user.ban');
    Route::post('/users/{id}/upload', 'UserController@uploadAvatar')->name('admin.user.upload');
    Route::patch('/users/{id}/reset', 'UserController@resetAvatar')->name('admin.user.avatar.reset');
});
