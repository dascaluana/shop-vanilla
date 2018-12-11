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

Route::get('/', 'PostController@index');

Route::get('/posts/create', 'PostController@create');

Route::post('/posts', 'PostController@store');

//Route::get('/posts/{post}', 'PostController@show');



