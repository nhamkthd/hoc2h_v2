var app = angular.module('hoc2h-editTest', ['infinite-scroll']);
app.controller('editTest',function($scope,$http){
	$scope.tab=1;
	$scope.categories=[];
	$scope.test=[];
	$scope.mtests=[];
	
	$http.get('/tests/api/getCategory').then(function(response) {
		$scope.categories = response.data;
	});

	$scope.initEditTest=function (id) {
		$http.get('/tests/api/getEditTest/'+id).then(function(response) {
			$scope.test = response.data;
		});
	}
	$scope.getMtests=function (id) {
		$http.get('/tests/api/getMtests/'+id).then(function(response) {
			$scope.mtests = response.data.mtest;
		});
	}
	$scope.submit_test=function () {
		$scope.tab=2;
	}
})