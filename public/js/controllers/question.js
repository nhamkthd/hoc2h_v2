(function(){
	'use strict';
	var app = angular.module('hoc2h-question', []);

	//app services
	app.factory('questionService',function(){
		var questionService = {};
		questionService.user = {};
		questionService.question = {};
    	questionService.answers = [];

    	questionService.addAnswers = function(answers) {
    		angular.forEach(answers, function(answer){
    			questionService.answers.push(answer);
    		});
    	}
    	return questionService;
	});
	//main question controller
	app.controller('QuestionController',function(){
		this.tab = 1;
	 	this.setSelectedTab = function(sTab){
	 		this.tab = sTab;
	 	}
	})

	//question detail controller
	app.controller('QuestionDetailController',function($http,$scope,$sce,$filter,questionService){
	 	
		 
		$scope.convertHtml = function(htmlText) {
               return $sce.trustAsHtml(htmlText);
        }

	 	$scope.initQuestion = function (question_id,user) {
	 		questionService.user = user;
	 		$scope.user = questionService.user;
	 		$scope.question ={};
	 		$http.post('/questions/api/getQuestionInfo/',{id:question_id})
	 			 .then(function(response){
	 			 	questionService.question = response.data.question;
	 			 	$scope.question = questionService.question;
	 			 	questionService.addAnswers($scope.question.answers);
	 			 	console.log('Question:',$scope.question);
	 			 	$scope.question_votes = $scope.question.votes.length;
	 			 	$scope.question_answers = $scope.question.answers.length;
					$scope.isVotedQuestion = response.data.isVoted;
	 			 },function(error){
	 			 	console.log(error);
	 		 });
		}

		$scope.voteQuestion = function(){
			$http.post('/questions/api/vote',{question_id:$scope.question.id,isVoted:$scope.isVotedQuestion})
	 			 .then(function(response){
	 			 	console.log(response);
	 			 	$scope.isVotedQuestion = response.data;
	 			 	if (response.data == 1) { $scope.question_votes++;}
	 			 	else if(response.data == 0) {$scope.question_votes--;}
	 			 },function(error){
	 			 	console.log(error);
	 		 });

		}

		$scope.addAnswer = function(){
			var answer_content = CKEDITOR.instances.answer_field.getData();
			$http.post('/questions/api/answers/',{question_id:$scope.question.id,content:answer_content})
	 			 .then(function(response){
	 			 	console.log(response.data);
	 			 	$scope.question.answers.push(response.data);
	 			 	$scope.question_answers++;
	 			 	CKEDITOR.instances.answer_field.setData('');
	 			 },function(error){
	 			 	console.log(error);
	 		 });
		}
	 });

	//answers controller
	 app.controller('AnswerController',function($scope,$http,questionService){
	 	$scope.isShowComments = 0;
	 	$scope.user = questionService.user;
	 	$scope.answers = questionService.answers;
	 	console.log('user:',$scope.user);
	 	console.log('answers:',$scope.answers);
	 	
	 	$scope.comments = function(answer_id){
	 	}
	 });

})();