<?php

Route::get('/', 'PostsController@index')->name('home');
Route::get('/home', 'PostsController@index');
Route::get('/posts/create', 'PostsController@create');
Route::post('/posts', 'PostsController@store');
Route::get('/posts/{post}', 'PostsController@show');
Route::get('/users/{user}', 'PostsController@userPosts');

Route::delete('/posts/{post}', 'PostsController@destroy');
Route::get('/edit/{post}', 'PostsController@edit');
Route::post('/posts/{post}/update', 'PostsController@update');

Route::post('/posts/{post}/comments', 'CommentsController@store');
Route::get('/posts/{post}/comments', 'CommentsController@index');
Route::delete('/comments/{comment}', 'CommentsController@destroy');

Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionsController@create')->name('login');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');
