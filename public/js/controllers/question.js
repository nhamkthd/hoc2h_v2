(function(){
	'use strict';
	var app = angular.module('hoc2h-question', []);
	app.run(function(){
		console.log('hello Question');
	});
	 
	 app.controller('QuestionController',function($http, $scope){
	 	$scope.tab = 2;
	 	$scope.questionDetail;

	 	$scope.selectTab = function(setTab){
	 		console.log(setTab);
	 		this.tab = setTab;
	 	}
	 	$scope.isSelected = function(checkTab) {
	 		return this.tab === checkTab;
	 	}
	 	
	 	$scope.createSubmit = function(){
	 		var content = CKEDITOR.instances.question_field.getData();
	 		var title = $scope.title;
	 		var category_id = $scope.category_id;
	 		$http.post('questions/api/create',{title:title, content:content, category_id:category_id})
	 			 .then(function(response){
	 			 	$scope.title = "";
	 			 	CKEDITOR.instances.question_field.setData('');
	 			 	$scope.questionDetail = response.data;
	 			 	$scope.tab = 5;
	 			 },function(error){
	 			 	console.log(error);
	 		 });
		}

	 });	
})();