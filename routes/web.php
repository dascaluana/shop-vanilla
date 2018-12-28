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

Auth::routes();

//Route::get('/', 'PostController@index')->name('index');
//Route::get('/test', function(){
//    dd(auth()->user());
//});

Route::get('/test', function() {

//    $persons = \App\Person::query()
//        ->with('phone')
//        ->get();
//    $phone = \App\Phone::query()
//        ->with('person')
//        ->get();
//
//    return $phone;
//    return $persons;

//    $posts = App\Post::query()
//        ->with('comments')
//        ->get();
//    return $posts;

//    $orders = \App\Order::query()
//        ->with([
//            'products',
//        ])
//        ->get();
//    return $orders;

//    $products = \App\Product::query()
//        ->with([
//            'orders',
//        ])
//        ->get();
//    return $products;

//    $products = \App\Product::query()->get();
//
//    return $products;

//    $orders = \App\Order::query()->get();
//
//    return $orders;

//    $countries = \App\Country::query()
//        ->with('posts.person')
//        ->get();
//
//    return $countries;

//    $staff = App\Staff::find(1);
//
//    foreach ($staff->photos as $photo)
//    {
//        return $photo;
//    }

//    $photo = App\Photo::query()
//                ->with('imageable')
//                ->get();
//
//    return $photo;

//    $post = App\Post::query()
//        ->with('tags')
//        ->get();
//
//    return $post;

//    $video = App\Video::query()
//        ->with('tags')
//        ->get();
//
//    return $video;

//    $posts = \App\Post::query()->has('comments')->get();
//
//    return $posts;

//    $posts = \App\Post::query()->has('comments', '>=', 2)->get();
//
//    return $posts;

//    $posts = \App\Post::whereHas('comments', function($q)
//    {
//        $q->where('body', 'like', 'com1%');
//
//    })->get();
//
//    return $posts;

//    $phone = \App\Phone::find(1);
//
//    return $phone->person->name;

//    foreach (\App\Post::with('comments')->get() as $comment)
//    {
//        echo $comment->body;
//    }

//    $posts = \App\Post::query()->with(['comments' => function($query)
//    {
//        $query->where('body', 'like', '%2');
//
//    }])->get();
//
//    return $posts;

//    $persons = \App\Person::with(['post' => function($query)
//    {
//        $query->orderBy('body', 'asc');
//
//    }])->get();
//
//    return $persons;

//    $persons = \App\Person::query()->get();
//
//    $persons->load('posts');
//
//    return $persons;

//    $comment = new \App\Comment([
//        'user_id' => 2,
//        'body' => 'A new comment.']);
//
//    $post = \App\Post::find(1);
//
//    $comment = $post->comments()->save($comment);
//
//    return $comment;


});

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

Route::get('/index', 'IndexController@index');

Route::get('/index/{product}', 'IndexController@add');

Route::get('/cart', 'CartController@index');

Route::get('/cart/{product}', 'CartController@remove');

Route::post('/cart', 'CartController@checkout');

Route::get('/login', 'LoginController@create')->name('login');

Route::post('/login', 'LoginController@store')->name('login-action');

Route::group(['middleware' => ['auth']], function() {

    Route::get('/logout', 'LoginController@destroy');

    Route::resource('products', 'ProductController');

    Route::get('/orders', 'OrderController@index');

    Route::get('/order/{order}', 'OrderController@show');
});

