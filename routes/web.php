<?php

use App\Post;

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


Route::group(["middleware" => "auth"], function () {
//    Route::get('/admin', 'Admin_posts@index')->name('index_posts');
    Route::get('/admin', 'Admin_posts@index')->name('index_posts');
    Route::get('/admin/posts/', 'Admin_posts@index')->name('index_posts');
    Route::post('/admin/posts/', 'Admin_posts@index')->name('index_postsUP');
    Route::get('/admin/classification/', 'Admin_classification@index')->name('index_classification');
    Route::get('/admin/admins/', 'Admin_users@index')->name('index_users');

});

Route::get('/', 'PostController@getIndex')->name('index');

Route::get('/{cat_url}', 'PostController@getCategoryPosts')->name('index');
Route::get('/author/post', 'Admin_posts@getPostForm')->name('post.form');
Route::post('/author/post', 'Admin_posts@createPost')->name('post.formUP');
Route::get('/author/cat', 'Admin_classification@getCatForm')->name('cat.form');
Route::post('/author/cat', 'Admin_classification@createCat')->name('cat.form');

Route::get('/post/cat/{cat_id}', 'PostController@getFullPost')->name('post.read');

Route::get('/author/post/detail/{id}', 'Admin_posts@getPost')->name('post.detail');
Route::get('/author/post/edit/{id}', 'Admin_posts@editPost')->name('post.edit');
Route::post('/author/post/edit/{id}', 'Admin_posts@updatePost')->name('post.update');
Route::get('/author/post/delete/{id}', 'Admin_posts@deletePost')->name('post.delete');


Route::get('/author/cat/detail/{id}', 'Admin_classification@getCat')->name('cat.detail');
Route::get('/author/cat/edit/{id}', 'Admin_classification@editCat')->name('cat.edit');
Route::post('/author/cat/edit/{id}', 'Admin_classification@updateCat')->name('cat.update');
Route::get('/author/cat/delete/{id}', 'Admin_classification@deleteCat')->name('cat.delete');


Route::get('/author/user/detail/{id}', 'Admin_users@getUser')->name('user.detail');
Route::get('/author/user/edit/{id}', 'Admin_users@editUser')->name('user.edit');
Route::post('/author/user/edit/{id}', 'Admin_users@updateUser')->name('user.update');
Route::get('/author/user/delete/{id}', 'Admin_users@deleteUser')->name('user.delete');


Route::get('admin/register', 'Admin_users@getAdmForm')->name('register');
Route::post('admin/register', 'Admin_users@createAdm')->name('register');


//Route::get('/admin', function () {
//    return 'Hello World';
//});
//Route::group(["middleware" => "auth"], function () {

//});

// Authentication Routes...
Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'Auth\LoginController@login');
Route::get('admin/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('admin/logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('admin/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('admin/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('admin/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('admin/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');





