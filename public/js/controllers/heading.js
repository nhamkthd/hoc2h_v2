(function(){
	var app = angular.module('hoc2h-heading', []);
	 app.run(function(){
	 	console.log('hello heading');
	 });
	 app.controller('HeadingController',function($scope, $http){
	 	console.log('hello heading controller..!')
	 });
})();