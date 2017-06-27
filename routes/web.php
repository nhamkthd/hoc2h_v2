<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'tests'], function(){
	Route::get('/',"TestController@index");

	Route::group(['prefix' => 'api'], function(){
		//this is group route api angular js
	});
});

Route::group(['prefix' => 'questions'], function(){
	Route::get('/',"QuestionController@index");

	Route::group(['prefix' => 'api'], function(){
		//this is group route api angular js
	});
});