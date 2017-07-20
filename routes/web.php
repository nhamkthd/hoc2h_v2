<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('pusher/auth', 'pusherController@pusherAuth');
Route::get('/tags','TagController@getAll');

Route::group(['prefix' => 'categories'],function(){
	Route::group(['prefix'=>'api'],function(){
		Route::get('/','CategoryController@getAll');
		Route::get('/{id}','CategoryController@getWithID');
	});
});

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
		Route::get('/getCategory', 'CategoryController@getAll');
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
	Route::get('/','QuestionController@index');
	Route::get('/tagged/','QuestionController@indexWithTagged');
	Route::get('/question-create','QuestionController@create')->name('showQuestionCreateFrom')->middleware('auth');
	Route::get('/question/{id}','QuestionController@showDetail');
	Route::get('/question-card',function(){
			return view('questions.directives.question_list_card');
		});
	Route::group(['prefix' => 'api'], function(){
		//this is group route api angular js
		Route::post('/store','QuestionController@store');
		Route::get('/','QuestionController@getAll');
		Route::post('/getQuestionInfo','QuestionController@apiQuestionWithID');
		Route::post('/vote','QuestionController@vote');
		Route::post('/edit','QuestionController@edit');
		Route::post('/delete','QuestionController@delete');
		Route::post('/editCategory','QuestionController@editCategory');
		Route::post('/change-resolve','QuestionController@changeResolve');
		Route::post('/add-Tags','QuestionController@addTags');
		Route::get('/search','QuestionController@search');
		Route::get('/tagged/{tag_id}','QuestionController@getQuestionsTagged');

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


	Route::group(['prefix' => 'notification'], function() {
	    Route::post('getNotification','NotificationController@show');
	    Route::post('readNotification','NotificationController@update');
	});