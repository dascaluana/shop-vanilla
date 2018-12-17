<?php

/*
 * posts
 *
 * GET /posts
 *
 * GET /posts/create
 *
 * POST /posts
 *
 * GET /post/{id}/edit
 *
 * GET /posts/{id}
 *
 * PATCH /posts/{id}
 *
 * DELETE /post/{id}
 */

//Auth::routes();

//Route::get('/', 'PostController@index')->name('index');

Route::get('/posts/create', 'PostController@create');

Route::post('/posts', 'PostController@store');

Route::get('/posts/{post}', 'PostController@show');

Route::get('/posts/tags/{tag}', 'TagsController@index');

Route::post('/posts/{post}/comments', 'CommentsController@store');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/register', 'RegistrationController@create');

Route::post('/register', 'RegistrationController@store');

//Route::get('/login', 'SessionController@create')->name('login');

//Route::post('/login', 'SessionController@store');

Route::get('/logout', 'SessionController@destroy');

Route::get('/index', 'IndexController@index');

Route::get('/index/{product}', 'IndexController@add');

Route::get('/cart', 'CartController@index');

Route::get('/cart/{product}', 'CartController@remove');

Route::post('/cart', 'CartController@checkout');

Route::get('/login', 'LoginController@create')->name('login');

Route::post('/login', 'LoginController@store')->name('login-action');

Route::resource('products', 'ProductController');

Route::get('/orders', 'OrderController@index');

Route::get('/order/{order}', 'OrderController@show');

