<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'tests'], function(){
	Route::get('/','TestController@index')->name('tests');
	Route::group(['prefix' => 'api'], function(){
		//this is group route api angular js
	});
});

Route::group(['prefix' => 'questions'], function(){
	Route::get('/','QuestionController@index')->name('questions');

	Route::group(['prefix' => 'api'], function(){
		//this is group route api angular js
		Route::post('/create','QuestionController@create');
	});
});