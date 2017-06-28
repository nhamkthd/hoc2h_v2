(function(){
	 var app = angular.module('hoc2h-quuestion', []);
	 app.run(function(){
	 	console.log('hello questions');
	 });
	 app.controller('QuestionController',function($http, $scope){
	 	$scope.total = $scope.x + $scope.y;
	 	$scope.users = {};
	 	$scope.header = "heloo"
	 	$scope.loading = true;
	 	$http.get('tests/api/users').
	 		then(function(response) {
	 			
		        $scope.users = response.data;
		        console.log($scope.users);
		        $scope.loading = false;
		    });
	 });
})();