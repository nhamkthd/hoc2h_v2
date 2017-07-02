(function(){
	'use strict';
	var app = angular.module('hoc2h-question', []);
	app.run(function(){
		console.log('hello Question');
	});
	 
	 app.controller('QuestionController',function($http, $scope, $sce,$filter){
	 	$scope.tab = 1;
	 	$scope.isShowAnswers = 0;
	 	$scope.selectTab = function(setTab){
	 		this.tab = setTab;
	 	}
	 	$scope.isSelected = function(checkTab) {
	 		return this.tab === checkTab;
	 	}
		 
		$scope.convertHtml = function(htmlText) {
               return $sce.trustAsHtml(htmlText);
        }

	 	$scope.initQuestion = function (question,user,votes_count,answers_count,isVoted) {
			this.question = question;
			this.question_author = user;
			this.question_votes = votes_count;
			this.question_answers = answers_count;
			this.isVotedQuestion = isVoted;
		}

		$scope.voteQuestion = function(){
			$http.post('/questions/api/vote',{question_id:this.question.id,isVoted:this.isVotedQuestion})
	 			 .then(function(response){
	 			 	console.log(response);
	 			 	$scope.isVotedQuestion = response.data;
	 			 	if (response.data == 1) { $scope.question_votes++;}
	 			 	else if(response.data == 0) {$scope.question_votes--;}
	 			 },function(error){
	 			 	console.log(error);
	 		 });

		}

		$scope.answer = function(){
			$scope.isShowAnswers = 1;
			$scope.answers = [];
			$http.post('/questions/api/answers/',{question_id: this.question.id})
	 			 .then(function(response){
	 			 	$scope.answers = response.data;
	 			 },function(error){
	 			 	console.log(error);
	 		 });
		}
	 });

	 app.controller('AnswerController',function($rootScope, $scope,$http){
	 	$scope.isShowComments = 0;
	 	$scope.isVotedAnswer = 0;
	 	$scope.isVotedComment = 0;

	 	$scope.comments = function(answer_id){
	 		console.log('click...');
	 		$scope.isShowComments = 1;
	 		$scope.coments = [];
	 		$http.post('/questions/api/answer/comments',{answer_id:answer_id})
	 			 .then(function(response){
	 			 	console.log(response.data);
	 			 	$scope.coments = response.data;
	 			 },function(error){
	 			 	console.log(error);
	 		 });
	 	}
	 });
})();