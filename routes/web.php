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

URL::forceScheme('https');

Auth::routes();

// laravel.local/

Route::get('/page/{page?}', 'HomeController@index')->name('homePaginate');

Route::get('/', 'HomeController@index')->name('home');

// laravel.local/hot

Route::get('/hot/page/{page?}', 'HomeController@hot')->name('hotPaginate');

Route::get('/hot', 'HomeController@hot')->name('hot');

// laravel.local/post

Route::post('/post', 'PostController@store')->name('storePost')->middleware('auth');

Route::get('/post/edit/{id}/view', 'PostController@editView')->name('editPostView')->middleware('auth');

Route::get('/post/edit/{id}', 'PostController@edit')->name('editPost')->middleware('auth');

Route::post('/post/edit/{id}', 'PostController@editStore')->name('editPostStore')->middleware('auth');

Route::get('/post/delete/{id}', function($id){
    return redirect()->route('post', ['id' => $id]);
})->middleware('auth');

Route::post('/post/delete/{id}', 'PostController@delete')->name('deletePost')->middleware('auth');

Route::get('/post/like/{id}/view', 'LikeController@likePostView')->name('likePostView');

Route::post('/post/like/{id}', 'LikeController@likePost')->name('likePost');

Route::get('/post/{id}/{slug}', 'PostController@post')->name('postSlug');

Route::get('/post/{id}', 'PostController@post')->name('post');

// laravel.local/comment

Route::post('/post/{id}/comment', 'CommentController@store')->name('storeComment')->middleware('auth');

Route::get('/comment/edit/{id}/view', 'CommentController@editView')->name('editCommentView')->middleware('auth');

Route::get('/comment/edit/{id}', 'CommentController@edit')->name('editComment')->middleware('auth');

Route::post('/comment/edit/{id}', 'CommentController@editStore')->name('editCommentStore')->middleware('auth');

Route::get('/comment/delete/{id}', function($id){
    return redirect()->route('post', ['id' => $id]);
})->middleware('auth');

Route::post('/comment/delete/{id}', 'CommentController@delete')->name('deleteComment')->middleware('auth');

Route::get('/comment/like/{id}/view', 'LikeController@likeCommentView')->name('likeCommentView');

Route::post('/comment/like/{id}', 'LikeController@likeComment')->name('likeComment');

// laravel.local/profile

Route::get('/profile/{username}/page/{page?}', 'ProfileController@profile')->name('profilePaginate');

Route::get('/profile/{username}', 'ProfileController@profile')->name('profile');

// laravel.local/settings

Route::get('/settings', function(){
    return redirect()->route('settingsAvatar');
})->name('settings')->middleware('auth');

Route::get('/settings/avatar', 'ProfileController@avatar')->name('settingsAvatar')->middleware('auth');

Route::post('/settings/avatar', 'ProfileController@avatarStore')->name('settingsAvatarStore')->middleware('auth');

Route::get('/settings/password', 'ProfileController@password')->name('settingsPassword')->middleware('auth');

Route::post('/settings/password', 'ProfileController@passwordStore')->name('settingsPasswordStore')->middleware('auth');

Route::get('/settings/email', 'ProfileController@email')->name('settingsEmail')->middleware('auth');

Route::post('/settings/email', 'ProfileController@emailStore')->name('settingsEmailStore')->middleware('auth');

// laravel.local/tags

Route::get('/tag/{name}/page/{page}', 'TagController@tag')->name('tagPaginate');

Route::get('/tag/{name}', 'TagController@tag')->name('tag');

Route::get('/tags', 'TagController@tags')->name('tags');

// laravel.local/users

Route::get('/users/page/{page}', 'HomeController@users')->name('usersPaginate');

Route::get('/users', 'HomeController@users')->name('users');
