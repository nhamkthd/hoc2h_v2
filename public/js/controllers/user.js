(function(){
	'use strict';
	var app = angular.module('hoc2h-user', ['infinite-scroll']);
	
	app.run(['$anchorScroll', function($anchorScroll) {
  		$anchorScroll.yOffset = 50;   // always scroll by 50 extra pixels
  		console.log('hello user...');
	}]);

	//main user controller
	app.controller('UserController',function($scope, $http,$sce){
		
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
			if (tab == 3) {$scope.setSettingTab(1)}
		}

		$scope.setSettingTab = function(tab){
			$scope.settingTab = tab;
			console.log($scope.settingTab);
		}

		$scope.getUser = function($id,tab){
			$scope.setTab(tab);
			$http.get('/users/api/user-profile/'+$id)
				 .then(function(response){
				 	$scope.user = response.data;
				 	$scope.local_edit = $scope.user.local;
				 },function(error){
				 	console.log(error);
				 });
		}

		$scope.editProfile = function(){
			$http.post('/users/api/edit',{id:$scope.user.id,
										  name:$scope.name_edit,
										  phone:$scope.phone_edit,
										  local:$scope.local_edit,
										  birthday:$scope.birthday_edit,
										  gender:$scope.gender_edit,
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