<?php

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login')->name('auth.login');
    Route::post('logout', 'AuthController@logout')->name('auth.logout');
    Route::post('refresh', 'AuthController@refresh')->name('auth.refresh');
    Route::post('me', 'AuthController@me')->name('auth.me');
    Route::post('payload', 'AuthController@payload')->name('auth.payload');
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('books', 'BooksController@index')->name('books.index');
    Route::get('books/create', 'BooksController@create')->name('books.create');
    Route::get('books/{book}', 'BooksController@show')->name('books.show')->where('book', '[0-9]+');
    Route::patch('books/{book}', 'BooksController@update')->name('books.update')->where('book', '[0-9]+');
    Route::delete('books/{book}', 'BooksController@destroy')->name('books.destroy')->where('book', '[0-9]+');
});
