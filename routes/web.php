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
	Route::post('create_write_test','WTestController@store')->name('create_write_test');
	Route::group(['prefix' => 'api'], function(){
		//this is group route api angular js
		Route::get('/getCategory', 'CategoryController@show');
		Route::post('/create_mtest', 'MTestController@store');
	});
});

Route::group(['prefix' => 'questions'], function(){
	Route::get('/','QuestionController@index')->name('questions');
	Route::get('/question-create','QuestionController@create')->name('showQuestionCreateFrom');
	Route::get('/question/{id}','QuestionController@showDetail');
	Route::post('/store','QuestionController@store')->name('storeQuestion');
	Route::group(['prefix' => 'api'], function(){
		//this is group route api angular js
		Route::post('/getQuestionInfo','QuestionController@apiQuestionWithID');
		Route::post('/vote','QuestionController@vote');

		Route::post('/answers','AnswerController@store');
		Route::post('/answer/vote','AnswerController@vote');
		Route::post('/answer/comment-add','AnswerController@addComment');
		Route::post('answer/comment/vote','AnswerController@voteCommment');
	});
});