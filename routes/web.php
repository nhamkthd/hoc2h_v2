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
		Route::get('/users','TestController@listUser');
	});
});

Route::group(['prefix' => 'questions'], function(){
	Route::get('/{id}',"QuestionController@index");
	Route::post('/create','QuestionController@create');

	Route::group(['prefix' => 'api'], function(){
		//this is group route api angular js
	});
});