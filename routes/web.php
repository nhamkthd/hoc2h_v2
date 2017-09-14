<?php

Route::get('/', function () {
    return view('welcome');
});

//AUTH
Auth::routes();
Route::get('/redirect', 'Auth\SocialAuthController@redirect');
Route::get('/callback', 'Auth\SocialAuthController@callback');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('pusher/auth', 'pusherController@pusherAuth');
Route::get('/tags/{category_id}','TagController@getAll');

Route::group(['prefix' => 'categories'],function(){
	Route::group(['prefix'=>'api'],function(){
		Route::get('/','CategoryController@getAll');
		Route::get('/parents-categories','CategoryController@getParents');
		Route::get('/{id}','CategoryController@getWithID');

	});
});
//USER
Route::group(['prefix'=>'users'],function(){
	Route::get('/{id}/{tab?}','UserController@userIndex')->where('id', '[0-9]+');
	Route::group(['prefix'=>'api'],function(){
		//GET METHOD
		Route::get('all-users','UserController@getAll');
		Route::get('/user-profile/{id}','UserController@apiGetProfile');
		Route::get('/user-activity-overview/{user_id}','UserController@getActivityOverview');
		Route::get('/user-questions/{user_id}/{sort_id}','QuestionController@apiGetUserQuestions');
		Route::get('/user-answers/{user_id}/{sort_id}','AnswerController@getUserAnswers');
		Route::get('/user-Test/{user_id}/{sort_id}','TestController@getUserTests');
		Route::get('/user-MyTest/{user_id}/{sort_id}','UserTestController@getMyTests');
		Route::get('/user-request-answer/{user_id}/{sort_id}','QuestionController@apiGetUserRequestAnswer');
		//POST METHOD
		Route::post('/edit','UserController@userEdit');
		Route::post('/update-user-private','UserController@updateUserPrivate');
		Route::post('/change-email','UserController@changeEmail');
		Route::post('/change-password','UserController@changePassword');
		Route::post('/update-notification-setting','UserController@updateNotificationSetting');

		Route::group(['prefix'=>'directives'],function(){
		});
	});
});

//TESTS
Route::group(['prefix' => 'tests','middleware'=>'auth'], function(){
	Route::get('/','TestController@index')->name('tests');
	Route::get('create', function() {
	    return view('tests.create');
	});
	Route::get('/tests-card',function(){
			return view('tests.directives.test_list_card');
		});
	Route::get('edit/{id}','TestController@getEdit');
	Route::post('usertest','TestController@userTest');
	Route::get('gettest','TestController@getListTest');
	Route::post('create_write_test','WTestController@store')->name('create_write_test');
	Route::get('show/{id}/{id_comment?}', 'TestController@show');
	Route::post('/usertest/submittestchoice','UserTestController@store');
	Route::get('usetest/result/{usertest_id}/{countIsCorrect}','UserTestController@result');
	Route::group(['prefix' => 'api'], function(){
		//this is group route api angular js
		Route::get('/getCategory', 'CategoryController@getAll');
		Route::post('/create_mtest', 'MTestController@store');
		Route::post('/edit_mtest', 'MTestController@edit');
		Route::post('deleteqa', 'MTestController@delete');
		Route::post('deleteanswer', 'MTestController@deleteanswer');
		Route::post('/getTest', 'TestController@getTest');
		Route::post('/postCmt', 'TestCommentController@postCmt');
		Route::post('/editComment', 'TestCommentController@postEditComment');
		Route::post('/postDeleteCmt', 'TestCommentController@postDeleteCmt');
		Route::post('/postAddRate', 'RateTestController@postAddRate');
		Route::post('/likeComment', 'LikeCommentTestController@postLikeComment');
		Route::post('/dislikeComment', 'LikeCommentTestController@postDislikeComment');
		Route::get('/search','TestController@search');
		Route::get('/getCommentTest/{test_id}','TestCommentController@getCommentTest');
		Route::get('/getEditTest/{id}','TestController@getEditTest');
		Route::get('/getMtests/{id}','MTestController@getMtests');
	});
});

//QUESTIONS
Route::group(['prefix' => 'questions'], function(){
	Route::get('/','QuestionController@index');
	Route::get('/tagged/','QuestionController@indexWithTagged');
	Route::get('/question-create','QuestionController@create')->name('showQuestionCreateFrom')->middleware('auth');
	Route::get('/question/{id}/{answer_id?}/{comment_id?}','QuestionController@showDetail');
	Route::get('/question-card',function(){
			return view('questions.directives.question_list_card');
		});
	Route::group(['prefix' => 'api'], function(){
		//this is group route api angular js
		
		Route::get('/','QuestionController@apiGetAll');
		Route::get('/question-detail/{question_id}/{answer_id}/{comment_id}','QuestionController@apiQuestionWithID');
		Route::get('/search','QuestionController@apiSearch');
		Route::get('/search-related','QuestionController@apiSearchWithTitle');
		Route::get('/tagged/{tag_id}','QuestionController@apiGetQuestionsTagged');
		Route::get('/related/{question_id}','QuestionController@getQuestionsRelated');		
		Route::post('/store','QuestionController@apiStore');
		Route::post('/vote','QuestionController@apiVote');
		Route::post('/edit','QuestionController@apiEdit');
		Route::post('/delete','QuestionController@apiDelete');
		Route::post('/editCategory','QuestionController@apiEditCategory');
		Route::post('/change-resolve','QuestionController@apiChangeResolve');
		Route::post('/add-Tags','QuestionController@apiAddTags');
		Route::post('/request-answer','QuestionController@requestAnswer');
		
		Route::get('/answers/question-id/{question_id}', 'AnswerController@apiGetAnswer');
		Route::post('/answers','AnswerController@store');
		Route::post('/answer/vote','AnswerController@vote');
		Route::post('/answer/edit','AnswerController@edit');
		Route::post('/answer/delete','AnswerController@delete');
		Route::post('/answer/set-best','AnswerController@setBestAnswer');

		Route::post('/answer/comment-add','AnswerController@addComment');
		Route::post('/answer/comment/vote','AnswerController@voteCommment');
		Route::post('/answer/comment/edit','AnswerController@editComment');
		Route::post('/answer/comment/delete','AnswerController@deleteComment');
	});
});
//message
Route::group(['prefix' => 'messages'], function(){
		Route::group(['prefix' => 'api'], function(){
			Route::get('getMessage/{id}', 'MessageController@getMessage');
			Route::get('getconversation/{id}', 'MessageController@getconversation');
			Route::get('listUserOnline', 'MessageController@listUserOnline');
			Route::post('getconversationopen', 'MessageController@getConversationOpen');
			Route::post('create','MessageController@create');
		});
	});
//NOTIFICATIONS
Route::group(['prefix' => 'notification'], function() {
	Route::post('getNotification','NotificationController@show');
	Route::post('readNotification','NotificationController@update');
});


//ADMIN
Route::get('admin/login',array('as'=>'getlogin','uses'=>'LoginController@index'));
Route::post('admin/login',array('as'=>'postlogin','uses'=>'LoginController@login'));
Route::get('signout',array('as'=>'signout','uses'=>'LoginController@signout'));

Route::group(['middleware'=>['login']],function(){
	Route::group(['prefix'=>'admin'],function(){
		Route::get('',array('as'=>'homeadmin',function(){return view('admin.business.admin.admin');}));
		Route::get('category',array('as'=>'indexCategory','uses'=>'CategoryController@index'));
		Route::get('category/create',array('as'=>'getcreateCategory','uses'=>'CategoryController@getCreate'));
		Route::post('category/create',array('as'=>'postcreateCategory','uses'=>'CategoryController@postCreate'));
		Route::get('category/create/{category}',array('as'=>'getcreateCategoryid','uses'=>'CategoryController@getCreateid'));
		Route::post('category/create/{category}',array('as'=>'postcreateCategoryid','uses'=>'CategoryController@postCreateid'));
		Route::get('category/show/{category}',array('as'=>'showCategory','uses'=>'CategoryController@Show'));
		Route::post('category/show/{category}',array('as'=>'updateCategory','uses'=>'CategoryController@update'));
		// Route::get('category/{id}',array('as'=>'destroyCategory','uses'=>'CategoryController@destroy'));
		Route::get('category/setting',function()
		{
			return view('admin.business.category.setting');
		});

		Route::get('user',array('as'=>'indexUser','uses'=>'UserController@index'));
		Route::get('profile', function() {
		    return view('admin.business.user.profile');
		});
		Route::get('user/create',array('as'=>'getcreateUser','uses'=>'UserController@getCreate'));
		Route::post('user/create',array('as'=>'postcreateUser','uses'=>'UserController@postCreate'));
		Route::get('user/show/{user}',array('as'=>'showUser','uses'=>'UserController@Show'));
		Route::post('user/show/{user}',array('as'=>'updateUser','uses'=>'UserController@update'));
		Route::get('user/{id}',array('as'=>'destroyUser','uses'=>'UserController@destroy'));

		Route::get('role',array('as'=>'indexRole','uses'=>'RoleController@index'));
		Route::get('role/permission/{id}',array('as'=>'indexRole','uses'=>'UserPermissionsController@index'));
		Route::post('permission/update','UserPermissionsController@update');

		Route::get('tag', 'TagController@index');
		Route::group(['prefix' => 'api'], function() {
		    Route::group(['prefix' => 'role'], function() {
		        Route::get('list', 'RoleController@getList');
		        Route::post('create', 'RoleController@create');
		        Route::delete('delete/{id}', 'RoleController@destroy');
		        Route::put('update', 'RoleController@update');
		    });
		    Route::group(['prefix' => 'user'], function() {
		        Route::post('Multidelete', 'UserController@multiDelete');
		        Route::get('list', 'UserController@getList');
		        Route::get('search', 'UserController@search');
		    });
		    Route::group(['prefix' => 'category'], function() {
		        Route::get('list', 'CategoryController@getList')->name('create');
		    });
		});

	});
});