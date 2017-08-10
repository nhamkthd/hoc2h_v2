<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/redirect', 'Auth\SocialAuthController@redirect');
Route::get('/callback', 'Auth\SocialAuthController@callback');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('pusher/auth', 'pusherController@pusherAuth');
Route::get('/tags','TagController@getAll');

Route::group(['prefix' => 'categories'],function(){
	Route::group(['prefix'=>'api'],function(){
		Route::get('/','CategoryController@getAll');
		Route::get('/{id}','CategoryController@getWithID');

	});
});

Route::group(['prefix'=>'users'],function(){
	Route::get('/{id}/{tab?}','UserController@userIndex')->where('id', '[0-9]+');
	Route::group(['prefix'=>'api'],function(){
		Route::get('user-profile/{id}','UserController@apiGetProfile');
		Route::get('/user-private/{id}','UserController@getUserPrivate');
		Route::post('/edit','UserController@userEdit');
		Route::post('/update-user-private','UserController@updateUserPrivate');
		Route::group(['prefix'=>'directives'],function(){
		});
	});
});

Route::group(['prefix' => 'tests','middleware'=>'auth'], function(){
	Route::get('/','TestController@index')->name('tests');
	Route::get('create', function() {
	    return view('tests.create');
	});
	Route::get('/tests-card',function(){
			return view('tests.directives.test_list_card');
		});
	Route::post('usertest','TestController@userTest');
	Route::get('gettest','TestController@getListTest');
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
		Route::get('/search','TestController@search');
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
		Route::post('/store','QuestionController@apiStore');
		Route::get('/','QuestionController@apiGetAll');
		Route::post('/getQuestionInfo','QuestionController@apiQuestionWithID');
		Route::post('/vote','QuestionController@apiVote');
		Route::post('/edit','QuestionController@apiEdit');
		Route::post('/delete','QuestionController@apiDelete');
		Route::post('/editCategory','QuestionController@apiEditCategory');
		Route::post('/change-resolve','QuestionController@apiChangeResolve');
		Route::post('/add-Tags','QuestionController@apiAddTags');
		Route::get('/search','QuestionController@apiSearch');
		Route::get('/search-related','QuestionController@apiSearchWithTitle');
		Route::get('/tagged/{tag_id}','QuestionController@apiGetQuestionsTagged');

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

	Route::get('admin/login',array('as'=>'getlogin','uses'=>'LoginController@index'));
Route::post('admin/login',array('as'=>'postlogin','uses'=>'LoginController@login'));
Route::get('signout',array('as'=>'signout','uses'=>'LoginController@signout'));

Route::group(['middleware'=>['login']],function(){
	Route::group(['prefix'=>'admin'],function(){
		Route::get('',array('as'=>'homeadmin',function(){return view('admin.layouts.master');}));
		Route::get('category',array('as'=>'indexCategory','uses'=>'CategoryController@index'));
		Route::get('category/create',array('as'=>'getcreateCategory','uses'=>'CategoryController@getCreate'));
		Route::post('category/create',array('as'=>'postcreateCategory','uses'=>'CategoryController@postCreate'));
		Route::get('category/create/{category}',array('as'=>'getcreateCategoryid','uses'=>'CategoryController@getCreateid'));
		Route::post('category/create/{category}',array('as'=>'postcreateCategoryid','uses'=>'CategoryController@postCreateid'));
		Route::get('category/show/{category}',array('as'=>'showCategory','uses'=>'CategoryController@Show'));
		Route::post('category/show/{category}',array('as'=>'updateCategory','uses'=>'CategoryController@update'));
		Route::get('category/{id}',array('as'=>'destroyCategory','uses'=>'CategoryController@destroy'));

		Route::get('user',array('as'=>'indexUser','uses'=>'UserController@index'));
		Route::get('user/create',array('as'=>'getcreateUser','uses'=>'UserController@getCreate'));
		Route::post('user/create',array('as'=>'postcreateUser','uses'=>'UserController@postCreate'));
		Route::get('user/show/{user}',array('as'=>'showUser','uses'=>'UserController@Show'));
		Route::post('user/show/{user}',array('as'=>'updateUser','uses'=>'UserController@update'));
		Route::get('user/{id}',array('as'=>'destroyUser','uses'=>'UserController@destroy'));

		Route::get('role',array('as'=>'indexRole','uses'=>'RoleController@index'));
		Route::get('role/create',array('as'=>'getcreateRole','uses'=>'RoleController@getCreate'));
		Route::post('role/create',array('as'=>'postcreateRole','uses'=>'RoleController@postCreate'));
		Route::get('role/show/{role}',array('as'=>'showRole','uses'=>'RoleController@Show'));
		Route::post('role/show/{role}',array('as'=>'updateRole','uses'=>'RoleController@update'));
		Route::get('role/{id}',array('as'=>'destroyRole','uses'=>'RoleController@destroy'));
	});
});