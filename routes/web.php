<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/forum', 'ForumsController@index')->name('forum');

Route::get('{provider}/auth', 'SocialsController@auth')->name('social.auth');

Route::get('/{provider}/redirect', 'SocialsController@auth_callback')->name('social.callback');

Route::get('discuss', function () {
    return view('discuss');
});
Route::get('discussion/{slug}', 'DiscussionsController@show')->name('discussion');

Route::get('channel/{slug}', 'ForumsController@channel')->name('channel');

// Admin routes
Route::group(['middleware' => ['auth']], function () {
    Route::resource('channels', 'ChannelsController');

    Route::get('discussion/edit/{slug}', 'DiscussionsController@edit')->name('discussion.edit');
    Route::get('discussion/create/new', 'DiscussionsController@create')->name('discussion.create');    
    Route::post('discussion/store', 'DiscussionsController@store')->name('discussion.store');
    Route::post('discussion/reply/{id}', 'DiscussionsController@reply')->name('discussion.reply');
    Route::post('discussion/update/{id}', 'DiscussionsController@update')->name('discussion.update');
    
    Route::get('relpy/like/{id}', 'RepliesController@like')->name('reply.like');
    Route::get('relpy/unlike/{id}', 'RepliesController@unlike')->name('reply.unlike');
    Route::get('discussion/best/reply/{id}', 'RepliesController@best_answer')->name('reply.best.answer');

    Route::get('discussion/watch/{id}', 'WatchersController@watch')->name('watch');
    Route::get('discussion/unwatch/{id}', 'WatchersController@unwatch')->name('unwatch');
    
    
});