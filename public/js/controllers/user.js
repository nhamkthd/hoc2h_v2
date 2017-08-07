(function(){
	'use strict';
	var app = angular.module('hoc2h-user', ['infinite-scroll']);
	app.run(['$anchorScroll', function($anchorScroll) {
  		$anchorScroll.yOffset = 50;   // always scroll by 50 extra pixels
  		console.log('hello user...');
	}]);

	
	//main user controller
	app.controller('UserController',function($scope, $http,$sce, Upload){
		
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
		 ]
		$scope.setTab = function(tab){
			$scope.currentTab = tab;
			if (tab == 3) {
				$scope.setSettingTab(1);
			}
		}
		$scope.getUser = function($id,tab){
			$http.get('/users/api/user-profile/'+$id)
				 .then(function(response){
				 	$scope.user = response.data;
				 	$scope.setTab(tab);
				 },function(error){
				 	console.log(error);
			});
		}
		$scope.setEditingUser = function(user){
			$scope.name_edit = user.name;
			$scope.phone_edit = user.phone;
			$scope.birthday_edit = user.birthday;
			$scope.local_edit = user.local;
			$scope.class_edit = user.class;
			$scope.description_edit = user.description;	
		}

		$scope.setSettingTab = function(tab){
			$scope.settingTab = tab;
			if (tab == 1) {
				$scope.setEditingUser($scope.user);
			}
		}

		$scope.uploadAvatar = function (file) {
	        Upload.upload({
	        	headers: {'Authorization': 'Client-ID 5f83e114af0de78'},
	            url:'https://api.imgur.com/3/image',
	            method:'POST',
	            data: {image:file}
	        }).then(function (response) {
				console.log('avtar uploaded....!')
	           	$scope.user.avatar = response.data.data.link;
	        }, function (error) {
	            console.log(error);
	        }, function (evt) {
	            var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
	            //console.log('progress: ' + progressPercentage + '% ' + evt.config.data.image.name);
	        });
	    };
		$scope.editProfile = function(){
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
				 },function(error){
				 	console.log(error);
				 });
		}
	});
})();