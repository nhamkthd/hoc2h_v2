<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'tests','middleware'=>'auth'], function(){
	Route::get('/','TestController@index')->name('tests');
	Route::get('create', function() {
	    return view('tests.create');
	});
	Route::group(['prefix' => 'api'], function(){
		//this is group route api angular js
		Route::get('/getCategory', 'CategoryController@show');
	});
});

Route::group(['prefix' => 'questions'], function(){
	Route::get('/','QuestionController@index')->name('questions');

	Route::group(['prefix' => 'api'], function(){
		//this is group route api angular js
		Route::post('/create','QuestionController@create');
	});
});