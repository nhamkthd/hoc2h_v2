(function(){
	'use strict';
	var app = angular.module('hoc2h-user', ['infinite-scroll']);
	app.run(['$anchorScroll', function($anchorScroll) {
  		$anchorScroll.yOffset = 50;   // always scroll by 50 extra pixels
  		console.log('hello user...');
	}]);
	
	//main user controller
	app.controller('UserController',function($scope, $http,$sce, Upload, Flash,$filter){

		$scope.setTab = function(tab){
			$scope.currentTab = tab;
			if (tab == 2) {
				$scope.setActivityTab(1);
				$scope.getActivityOverView();
			}else if (tab == 3) {
				$scope.setSettingTab(1);
			}
		}
		
		//get user infomation with user_id
		$scope.getUser = function($id,tab){
			$http.get('/users/api/user-profile/'+$id)
				 .then(function(response){
				 	console.log(response.data);
				 	$scope.user = response.data;
				 	$scope.setTab(tab);
				 },function(error){
				 	console.log(error);
			});
		}


		//------SETTINGS TAB ----------//
		
		$scope.setSettingTab = function(tab){
			$scope.settingTab = tab;
			if (tab == 1) {
				$scope.setEditingUser($scope.user);
			}else if (tab == 2) {
				$scope.show_profile = $scope.user.private_setting.view_detail_profile;
				$scope.send_message = $scope.user.private_setting.send_message;
				$scope.show_active = $scope.user.private_setting.show_active;
				$scope.show_birthday = $scope.user.private_setting.show_birthday;
				$scope.show_phone = $scope.user.private_setting.show_phone;
			} else if (tab == 3) {
				$scope.email = $scope.user.email;
			} else if (tab == 4) {
				$scope.peoples_following = $scope.user.notification_setting.peoples_following;
				$scope.post_following = $scope.user.notification_setting.post_following;
				$scope.your_post = $scope.user.notification_setting.your_post;
				$scope.new_follower = $scope.user.notification_setting.new_follower;
				$scope.new_message = $scope.user.notification_setting.new_message;
				$scope.question_can_answer = $scope.user.notification_setting.question_can_answer;
				$scope.request_answer = $scope.user.notification_setting.request_answer;
				$scope.coin_change = $scope.user.notification_setting.coin_change;

				$scope.email_peoples_following = $scope.user.notification_setting.email_peoples_following;
				$scope.email_post_following = $scope.user.notification_setting.email_post_following;
				$scope.email_your_post = $scope.user.notification_setting.email_your_post;
				$scope.email_new_follower = $scope.user.notification_setting.email_new_follower;
				$scope.email_new_message = $scope.user.notification_setting.email_new_message;
				$scope.email_question_can_answer = $scope.user.notification_setting.email_question_can_answer;
				$scope.email_request_answer = $scope.user.notification_setting.email_request_answer;
				$scope.email_coin_change = $scope.user.notification_setting.email_coin_change;
			}
		}

		//init arrays
		$scope.locals = [
			{name:"Đà Nẵng"},
			{name:"Hải Phòng"},
			{name:"Hà Nội"},
			{name:"TP HCM"},
		 	{name:"An Giang"},
			{name:"Bà Rịa - Vũng Tàu"},
			{name:"Bắc Giang"},
			{name:"Bắc Kạn"},
			{name:"Bạc Liêu"},
			{name:"Bắc Ninh"},
			{name:"Bến Tre"},
			{name:"Bình Định"},
			{name:"Bình Dương"},
			{name:"Bình Phước"},
			{name:"Bình Thuận"},
			{name:"Cà Mau"},
			{name:"Cao Bằng"},
			{name:"Đắk Lắk"},
			{name:"Đắk Nông"},
			{name:"Điện Biên"},
			{name:"Đồng Nai"},
			{name:"Đồng Tháp"},
			{name:"Gia Lai"},
			{name:"Hà Giang"},
			{name:"Hà Nam"},
			{name:"Hà Tĩnh"},
			{name:"Hải Dương"},
			{name:"Hậu Giang"},
			{name:"Hòa Bình"},
			{name:"Hưng Yên"},
			{name:"Khánh Hòa"},
			{name:"Kiên Giang"},
			{name:"Kon Tum"},
			{name:"Lai Châu"},
			{name:"Lâm Đồng"},
			{name:"Lạng Sơn"},
			{name:"Lào Cai"},
			{name:"Long An"},
			{name:"Nam Định"},
			{name:"Nghệ An"},
			{name:"Ninh Bình"},
			{name:"Ninh Thuận"},
			{name:"Phú Thọ"},
			{name:"Quảng Bình"},
			{name:"Quảng Nam"},
			{name:"Quảng Ngãi"},
			{name:"Quảng Ninh"},
			{name:"Quảng Trị"},
			{name:"Sóc Trăng"},
			{name:"Sơn La"},
			{name:"Tây Ninh"},
			{name:"Thái Bình"},
			{name:"Thái Nguyên"},
			{name:"Thanh Hóa"},
			{name:"Thừa Thiên Huế"},
			{name:"Tiền Giang"},
			{name:"Trà Vinh"},
			{name:"Tuyên Quang"},
			{name:"Vĩnh Long"},
			{name:"Vĩnh Phúc"},
			{name:"Yên Bái"},
			{name:"Phú Yên"},
			{name:"Cần Thơ"},
			
		 ];
		$scope.show_profile_objects = [{name: 'Tất cả', id: 1}, {name: 'Chỉ thành viên', id: 2}, {name: 'Chỉ người theo dõi bạn', id: 3}];
		$scope.send_message_objects = [{name: 'Thành viên', id: 1}, {name: 'Chỉ người theo dõi bạn', id: 2},] ;

		//set editing value
		$scope.setEditingUser = function(user){
			//var birthday_edit = element(by.binding('birthday_edit | date: "yyyy-MM-dd"'));
			$scope.name_edit = user.name;
			$scope.phone_edit = user.phone;
			$scope.birthday_edit = new Date(user.birthday); 
			$scope.local_edit = user.local;
			$scope.class_edit = user.class;
			$scope.description_edit = user.description;
			$scope.gender_edit = user.gender;
			$scope.avatar_text = "Cập nhật ảnh đại diện";
		}

		//uploading avatar photo
		$scope.uploadAvatar = function (file) {
	        Upload.upload({
	        	headers: {'Authorization': 'Client-ID 5f83e114af0de78'},
	            url:'https://api.imgur.com/3/image',
	            method:'POST',
	            data: {image:file}
	        }).then(function (response) {
				console.log('avtar uploaded....!',response.data.data);
	           	$scope.user.avatar = response.data.data.link;
	           	$scope.avatar_text = "Cập nhật ảnh đại diện"; 
	        }, function (error) {
	            console.log(error);
	        }, function (evt) {
	            var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
	            $scope.avatar_text = "Đang tải lên...";
	        });
	    };

	    //submit profile editing
		$scope.editProfile = function(){
			if ($scope.name_edit == "") {
				var message = 'Thuộc tính [<strong>tên hiển thị</strong>] không được để trống...!';
       			Flash.create('danger', message);
       			return;
			}
			$http.post('/users/api/edit',{id:$scope.user.id,
										  name:$scope.name_edit,
										  phone:$scope.phone_edit,
										  class:$scope.class_edit,
										  local:$scope.local_edit,
										  birthday:$scope.birthday_edit,
										  gender:$scope.gender_edit,
										  avatar:$scope.user.avatar,
										  description:$scope.description_edit})
				 .then(function(response){
				 	console.log(response.data);
				 	$scope.user = response.data;
				 	var message = '<strong>Thành công!</strong>Các thông tin thay đổi đã được cập nhật xong.';
       				Flash.create('success', message);
				 	flash.getMessage($scope.message);
				 },function(error){
				 	console.log(error);
				 });
		}

		//update user private 
		$scope.updateUserPrivate = function(){
			$http.post('/users/api/update-user-private',{id:$scope.user_private.id,
														 show_active:$scope.show_active,
														 show_birthday:$scope.show_birthday,
														 show_phone:$scope.show_phone,
														 show_profile:$scope.show_profile,
														 send_message:$scope.send_message})
			     .then(function(response){
			     	console.log(response.data);
			     	$scope.user_private = response.data;
			     	var message = '<strong>Thành công!</strong> Các thông tin thay đổi đã được cập nhật xong.';
       				Flash.create('success', message);
				 	flash.getMessage($scope.message);
			     },function(error){
			     	console.log(error.data);
			    });
		}

		//change email address
		$scope.changeEmail = function(){
			if ($scope.email == "") {
				var message = '<strong>Email</strong> không được để trống...!';
       			Flash.create('danger', message);
       			return;
			}

			$http.post('/users/api/change-email',{user_id:$scope.user.id, email:$scope.email})
				 .then(function (response) {
				 	console.log("new email updated:",response.data.email);
				 	$scope.user.email = response.data.email;
				 	var message = 'Email đã được cập nhật thành công...!';
       				Flash.create('success', message);
				 },function (error) {
				 	console.log(error.data);
				 });
		}

		//update notification settings
		$scope.updateNotifcationSetting = function(){
			$http.post('/users/api/update-notification-setting',{id:$scope.user.notification_setting.id,
																peoples_following: $scope.peoples_following,
																post_following:$scope.post_following,
																your_post:$scope.your_post,
																new_follower:$scope.new_follower,
																new_message:$scope.new_message,
																question_can_answer:$scope.question_can_answer,
																request_answer:$scope.request_answer,
																coin_change:$scope.coin_change,

																email_peoples_following:$scope.email_peoples_following,
																email_post_following:$scope.email_post_following,
																email_your_post:$scope.email_your_post,
																email_new_follower:$scope.email_new_follower,
																email_new_message:$scope.email_new_message,
																email_question_can_answer:$scope.email_question_can_answer,
																email_request_answer:$scope.email_request_answer,
																email_coin_change:$scope.email_coin_change,																
					}).then(function(response){
						console.log(response.data);
						$scope.user.notification_setting = response.data;
						var message = '<strong>Thành công!</strong> Các thông tin thay đổi đã được cập nhật.';
	       				Flash.create('success', message);
					 	flash.getMessage($scope.message);
					},function(error){
						console.log(error.data);
					});
		}

		//--------ACTIVYTI TAB---------//

		$scope.user_questions = '';
		$scope.user_answers = '';
		$scope.setActivityTab = function(tab){
			$scope.activityTab = tab;
			switch(tab){
				case 1:

					break;
				case 2:
					$scope.setQuestionSortTab(1);
					break;
				case 3:
					$scope.setAnswerSortTab(1);
					break;
				case 4:
					$scope.setRequestAnswerSortTab(1);
					break;
				case 5:
					$scope.setTestSortTab(1);
					break;
				case 6:
					$scope.setMyTestSortTab(1);
					break;
				default:
					break;
			}

		}
		//Over view tap
		$scope.getActivityOverView = function(){
			$http.get('/users/api/user-activity-overview/'+$scope.user.id)
				  .then(function(response){
				  	console.log(response.data);
				  	$scope.questions_overview = response.data.questions;
				  	$scope.answers_overview = response.data.answers;
				  	$scope.tests_created_overview =response.data.test_create;
				  	$scope.over_view_counts = response.data.over_view_counts;
				  },function(error){
				  	console.log(error.data)
				  });
		}

		//Question tab
		$scope.setQuestionSortTab = function(tab){
			$scope.questionSortTab = tab;
			$scope.pageQA=1;
			switch(tab){
				case 1:
					$scope.getUserQuestions(1);
					break;
				case 2:
					$scope.getUserQuestions(2);
					break;
				case 3:
					$scope.getUserQuestions(3);
					break;
				default:
					break;	
			}
		}

		$scope.getUserQuestions = function(sort){
			$http.get('/users/api/user-questions/'+$scope.user.id+'/'+sort)
				 .then(function(response){
				 	console.log('get user questions list...!',response.data);
				 	$scope.user_questions = response.data.data;
				 	$scope.maxpageQA=response.data.last_page;
				 	console.log($scope.maxpageQA);
				 },function(error){
				 	console.log(error.data);
				 });
		}

		$scope.loadingQa=function (tab) {
			$scope.pageQA++;
			$scope.isloadingQa=1;
			$http.get('/users/api/user-questions/'+$scope.user.id+'/'+tab+'?page='+$scope.pageQA)
				 .then(function(response){
				 	$scope.isloadingQa=0;
				 	console.log('get user questions list...!',response.data);
				 	for (var i = 0; i < response.data.data.length; i++) {
				 		$scope.user_questions.push(response.data.data[i]);
				 	}
				 	
				 },function(error){
				 	console.log(error.data);
				 });
		}
		//answer tab
		$scope.setAnswerSortTab = function (tab) {
			$scope.pageAS=1;
			$scope.answerSortTab = tab;
			switch(tab){
				case 1:
					$scope.getUserAnswers(1);
					break;
				case 2: 
					$scope.getUserAnswers(2);
					break;
				case 3:
					$scope.getUserAnswers(3);
					break;
			}
		}

		$scope.getUserAnswers = function (sort_id) {
			console.log('get user answers list...!');
			$http.get('/users/api/user-answers/'+$scope.user.id+'/'+sort_id)
				 .then(function (response) {
				 	$scope.maxpageAS=response.data.last_page;
				 	console.log(response.data);
				 	$scope.user_answers = response.data.data;
				 },function (error) {
				 	console.log(error.data);
			});
		}
		$scope.loadingAS=function (tab) {
			$scope.pageAS++;
			$scope.isloadingAS=1;
			$http.get('/users/api/user-answers/'+$scope.user.id+'/'+tab+'?page='+$scope.pageAS)
				 .then(function(response){
				 	$scope.isloadingAS=0;
				 	console.log('get user questions list...!',response.data);
				 	for (var i = 0; i < response.data.data.length; i++) {
				 		$scope.user_answers.push(response.data.data[i]);
				 	}
				 	
				 },function(error){
				 	console.log(error.data);
				 });
		}

		//request answer tab
		$scope.setRequestAnswerSortTab = function (tab) {
			$scope.requestAnswerSortTab = tab;
			switch(tab){
				case 1:
					$scope.getUserRequestAnswers(1);
					break;
				case 2: 
					$scope.getUserRequestAnswers(2);
					break;
				case 3:
					$scope.getUserRequestAnswers(3);
					break;

			}
		}

		$scope.getUserRequestAnswers = function (sort_id) {
			$http.get('/users/api/user-request-answer/'+$scope.user.id+'/'+sort_id)
				 .then(function (response) {
				 	console.log(response.data);
				 	$scope.request_answers = response.data;
				 },function (error) {
				 	console.log(error.data);
			});
		}
		//test tab
		$scope.setTestSortTab=function (tab) {
			$scope.TestSortTab = tab;
			$scope.pageTest=1;
			switch(tab){
				case 1:
					$scope.getUserTest(1);
					break;
				case 2: 
					$scope.getUserTest(2);
					break;
			}
		}
		$scope.getUserTest = function (sort_id) {
			$http.get('/users/api/user-Test/'+$scope.user.id+'/'+sort_id)
				 .then(function (response) {
				 	console.log(response.data.data);
				 	$scope.maxpageTest=response.data.last_page;
				 	$scope.total_test=response.data.total;
				 	$scope.user_tests = response.data.data;
				 },function (error) {
				 	console.log(error.data);
			});
		}
		$scope.loadingTest=function (tab) {
			$scope.pageTest++;
			$scope.isloadingTest=1;
			$http.get('/users/api/user-Test/'+$scope.user.id+'/'+tab+'?page='+$scope.pageTest)
				 .then(function (response) {
				 	$scope.isloadingTest=0;
				 	console.log(response.data.data);
				 	for (var i = 0; i < response.data.data.length; i++) {
				 		$scope.user_tests.push(response.data.data[i]);
				 	}
				 },function (error) {
				 	console.log(error.data);
			});
		}
		//my testing
		$scope.setMyTestSortTab=function (tab) {
			$scope.myTestSortTab = tab;
			$scope.pageMyTest=1;
			switch(tab){
				case 1:
					$scope.getMyTest(1);
					break;
				case 2: 
					$scope.getMyTest(2);
					break;
			}
		}
		$scope.getMyTest = function (sort_id) {
			$http.get('/users/api/user-MyTest/'+$scope.user.id+'/'+sort_id)
				 .then(function (response) {
				 	console.log(response.data.data);
				 	$scope.total_mytest=response.data.total;
				 	$scope.My_tests = response.data.data;
				 	$scope.maxpageMyTest=response.data.last_page;
				 },function (error) {
				 	console.log(error.data);
			});
		}
		$scope.loadingMyTest=function (tab) {
			$scope.pageMyTest++;
			$scope.isloadingTest=1;
			$http.get('/users/api/user-MyTest/'+$scope.user.id+'/'+tab+'?page='+$scope.pageMyTest)
				 .then(function (response) {
				 	$scope.isloadingTest=0;
				 	console.log(response.data.data);
				 	for (var i = 0; i < response.data.data.length; i++) {
				 		$scope.My_tests.push(response.data.data[i]);
				 	}
				 },function (error) {
				 	console.log(error.data);
			});
		}
	});
})();