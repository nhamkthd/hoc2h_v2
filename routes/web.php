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
	Route::get('UserCreate','TestController@getUserCreateTest');
	Route::post('usertest','TestController@userTest');
	Route::post('create_write_test','WTestController@store')->name('create_write_test');
	Route::get('show/{id}', 'TestController@show');
	Route::post('/usertest/submittestchoice','UserTestController@store');
	Route::get('usetest/result/{usertest_id}/{countIsCorrect}','UserTestController@result');
	Route::group(['prefix' => 'api'], function(){
		//this is group route api angular js
		Route::get('/getCategory', 'CategoryController@show');
		Route::post('/create_mtest', 'MTestController@store');
		Route::post('/getTest', 'TestController@getTest');
		Route::post('/postCmt', 'TestCommentController@postCmt');
		Route::post('/editComment', 'TestCommentController@postEditComment');
		Route::post('/postDeleteCmt', 'TestCommentController@postDeleteCmt');
		Route::post('/postAddRate', 'RateTestController@postAddRate');
		Route::post('/likeComment', 'LikeCommentTestController@postLikeComment');
		Route::post('/dislikeComment', 'LikeCommentTestController@postDislikeComment');

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
		Route::post('/edit','QuestionController@edit');
		Route::post('/delete','QuestionController@delete');

		Route::post('/answers','AnswerController@store');
		Route::post('/answer/vote','AnswerController@vote');
		Route::post('/answer/edit','AnswerController@edit');
		Route::post('/answer/delete','AnswerController@delete');

		Route::post('/answer/comment-add','AnswerController@addComment');
		Route::post('/answer/comment/vote','AnswerController@voteCommment');
		Route::post('/answer/comment/edit','AnswerController@editComment');
		Route::post('/answer/comment/delete','AnswerController@deleteComment');
	});
});