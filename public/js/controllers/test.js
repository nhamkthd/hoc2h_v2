(function(){
	 var app = angular.module('hoc2h-test', []);
	 app.run(function(){
	 	console.log('hello Test');
	 });
	 
	 app.controller('TestController',function($http, $scope){
	 	$scope.tab = 2;
	 	$scope.selectTab = function(setTab){
	 		console.log(setTab);
	 		this.tab = setTab;
	 	}
	 	$scope.isSelected = function(checkTab) {
	 		return this.tab === checkTab;
	 	}
	 });	
})();