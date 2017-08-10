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
			if (tab == 3) {
				$scope.setSettingTab(1);
				$scope.getUserPrivate();
			}
		}
		
		//get user infomation with user_id
		$scope.getUser = function($id,tab){
			$http.get('/users/api/user-profile/'+$id)
				 .then(function(response){
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
				console.log($scope.show_profile);
			}
		}

		$scope.getUserPrivate = function(){
			$http.get('/users/api/user-private/'+$scope.user.id)
				 .then(function(response){
				 	$scope.user_private = response.data[0];
				 	console.log('user-private: ',$scope.user_private);
				 	$scope.show_profile = $scope.user_private.view_detail_profile;
					$scope.send_message = $scope.user_private.send_message;
					$scope.show_active = $scope.user_private.show_active;
					$scope.show_birthday = $scope.user_private.show_birthday;
					$scope.show_phone = $scope.user_private.show_phone;
				 },function(error){
				 	console.log(error.data);
				 })
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

		//date picker setting
		$scope.dateOptions = {
		    formatYear: 'yy',
		    maxDate: new Date(2020, 5, 22),
		    minDate: new Date(1970,1,1),
		    startingDay: 1
		  };
		$scope.popup1 = {
		    opened: false
		};

		$scope.format = 'dd.MM.yyyy';

		$scope.birthdayFocus = function(){
			$scope.popup1.opened = true;
		}

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
	});
})();