<?php
declare(strict_types = 1);

Route::view('/', 'index')->name('index');

Route::get('articles', 'ArticleController@index');
Route::get('articles/{article}/users', 'UserController@getArticleUsers');
Route::get('articles/{article_id}/users/{user}', 'ArticleController@isAuthor');

Route::get('users', 'UserController@index');
Route::post('users', 'UserController@store')->name('user.store');
Route::get('users/{user}', 'UserController@show');
Route::get('users/{user_id}/experience', 'UserController@experience');
Route::get('users/{user}/articles', 'ArticleController@getUserArticles');
