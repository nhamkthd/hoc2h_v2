var app=angular.module('hoc2h-user', []);
app.run(function () {
	console.log('hello user');	
})
app.controller('userController', function ($scope,$http) {
	$scope.list_users=[];
	$scope.list_user=function () {
		$http.get('/admin/api/user/list').then(function function_name(res) {
			$scope.list_users=res.data;
			console.log(res.data);
		}, function function_name(err) {
			console.log(err);
		})
	}

})
