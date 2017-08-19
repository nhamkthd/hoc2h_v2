var app=angular.module('hoc2h-category', ['ng-nestable'])
app.run(function () {
	console.log('hello category');
})
app.controller('setting_itemCtrl',  function ($scope,$http) {
	$scope.items=[];
	$scope.list_category=function(){
		$http.get('/admin/api/category/list').then(function(res){
			$scope.items=res.data;
			console.log($scope.items);
		}, function(err){

		});
	}	
})