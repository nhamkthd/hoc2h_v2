(function(){
	'use strict';
	var app = angular.module('hoc2h-user', ['infinite-scroll']);
	app.run(['$anchorScroll', function($anchorScroll) {
  		$anchorScroll.yOffset = 50;   // always scroll by 50 extra pixels
  		console.log('hello user...');
	}]);
	
	//main user controller
	app.controller('UserController',function($scope, $http,$sce, Upload, Flash){
		
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
			{name:"Đà Nẵng"},
			{name:"Hải Phòng"},
			{name:"Hà Nội"},
			{name:"TP HCM"},
		 ];
		$scope.show_profile_objects = [{name: 'Tất cả', id: 1}, {name: 'Chỉ thành viên', id: 2}, {name: 'Chỉ người theo dõi bạn', id: 3}];
		$scope.send_message_objects = [{name: 'Thành viên', id: 1}, {name: 'Chỉ người theo dõi bạn', id: 2},] ;

		//set editing value
		$scope.setEditingUser = function(user){
			$scope.name_edit = user.name;
			$scope.phone_edit = user.phone;
			$scope.birthday_edit = user.birthday;
			$scope.local_edit = user.local;
			$scope.class_edit = user.class;
			$scope.description_edit = user.description;
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
				console.log('avtar uploaded....!');
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

		$scope.setActivityTab = function(tab){
			$scope.activityTab = tab;
			switch(tab){
				case 1:
					break;
				case 2:
					break;
				case 3:
					break;
				default:
					break;
			}

		}

		$scope.getActivityOverView = function(){
			$http.get('/users/api/user-activity-overview/'+$scope.user.id)
				  .then(function(response){
				  	console.log(response.data);
				  	$scope.questions_overview = response.data.questions;
				  	$scope.answers_overview = response.data.answers;
				  	$scope.tests_created_overview =response.data.test_create;
				  },function(error){
				  	console.log(error.data)
				  });
		}
	});
})();