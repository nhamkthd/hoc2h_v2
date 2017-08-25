(function(){
	var app = angular.module('hoc2h-message', []);
	app.run(function(){
		console.log("hello message");
	});

	app.controller('MessageController',function($scope, $http){
		
	});
})();