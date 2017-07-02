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
	Route::get('/question-create','QuestionController@create')->name('showQuestionCreateFrom');
	Route::get('/question/{id}','QuestionController@showDetail');
	Route::group(['prefix' => 'api'], function(){
		//this is group route api angular js
		Route::post('/vote','QuestionController@vote');
		Route::post('/answers','AnswerController@index');
		Route::post('/answer/comments','AnswerController@comments');
	});
});