(function(){
	'use strict';
	var app = angular.module('hoc2h-user', ['infinite-scroll']);
	
	app.run(['$anchorScroll', function($anchorScroll) {
  		$anchorScroll.yOffset = 50;   // always scroll by 50 extra pixels
  		console.log('hello user...');
	}]);

	//main user controller
	app.controller('UserController',function($scope, $http,$sce){
		$scope.setTab = function(tab){
			$scope.currentTab = tab;
		}
	});
})();