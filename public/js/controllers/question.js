(function(){
	'use strict';
	var app = angular.module('hoc2h-question', []);
	app.run(['$anchorScroll', function($anchorScroll) {
  		$anchorScroll.yOffset = 50;   // always scroll by 50 extra pixels
	}]);
	//app services
	app.factory('questionService',function(){
		var questionService = {};

    	return questionService;
	});
	//main question controller
	app.controller('QuestionController',function($scope){
		$scope.tab = 1;
	 	$scope.setSelectedTab = function(sTab){
	 		$scope.tab = sTab;
	 		// console.log('set selected tab:',sTab);
	 	}
	})

	//Question detail controller
	app.controller('QuestionDetailController',function($http,$scope,$sce,$filter,$anchorScroll,$location){
	 	
	 	//auto scroll
		$scope.gotoAnchor = function(x) {
	      	var newHash = 'anchor' + x;
	      	if ($location.hash() !== newHash) {
	        // set the $location.hash to `newHash` and
	        // $anchorScroll will automatically scroll to it
	        	$location.hash('anchor' + x);
	      	} else {
	        // call $anchorScroll() explicitly,
	        // since $location.hash hasn't changed
	        	$anchorScroll();
	      	}
	    };

	    //escape html tags
		$scope.convertHtml = function(htmlText) {
               return $sce.trustAsHtml(htmlText);
        }

        //init question form route
	 	$scope.initQuestion = function (question_id,user) {

	 		$scope.user = user;
	 		$scope.question ={};
	 		$scope.answers = [];
	 		$http.post('/questions/api/getQuestionInfo/',{id:question_id})
	 			 .then(function(response){
	 			 	console.log('Init question: ',response.data);
	 			 	$scope.question = response.data.question;
	 			 	$scope.question_votes = $scope.question.votes.length;
					$scope.isVotedQuestion = response.data.isVoted;
					$scope.answers = response.data.answers;
					$scope.answer_count = $scope.question.answers.length;
	 			 },function(error){
	 			 	console.log(error);
	 		 });
		}

		//vote question
		$scope.voteQuestion = function(){
			$http.post('/questions/api/vote',{question_id:$scope.question.id,isVoted:$scope.isVotedQuestion})
	 			 .then(function(response){
	 			 	console.log('Vote question: ',response);
	 			 	$scope.isVotedQuestion = response.data;
	 			 	if (response.data == 1) { $scope.question_votes++;}
	 			 	else if(response.data == 0) {$scope.question_votes--;}
	 			 },function(error){
	 			 	console.log(error);
	 		 });

		}

		//set default value when add new answer...
		var setNewAnswerDefault = function (answer_id) {
			$scope.answers.comments[answer_id] = {comments:[],users:[],voteCount:[],voted:[]};
	 		$scope.answers.commentCount[answer_id] = 0;
	 		$scope.answers.voteCount[answer_id] = 0;
	 		$scope.answers.voted[answer_id] = 0;
	 		$scope.answers.users[answer_id] = $scope.user;
		}
		//set default value when add new comment
		var setNewCommentDefault = function (comment_id,answer_id) {
			$scope.answers.comments[answer_id].users[comment_id] = $scope.user;
			$scope.answers.comments[answer_id].voteCount[comment_id] = 0;
			$scope.answers.comments[answer_id].voted[comment_id] = 0;
		}

		//ad new answer
		$scope.addAnswer = function(){
			var answer_content = CKEDITOR.instances.answer_field.getData();
			$http.post('/questions/api/answers/',{question_id:$scope.question.id,content:answer_content})
	 			 .then(function(response){
	 			 	console.log('Add new answer: ',response.data);
	 			 	var newAnswer = response.data;
	 			 	$scope.question.answers.push(newAnswer);
	 			 	$scope.answer_count++;
	 			 	setNewAnswerDefault(newAnswer.id);
	 			 	console.log($scope.answers);
	 			 	CKEDITOR.instances.answer_field.setData('');
	 			 },function(error){
	 			 	console.log(error);
	 		 });
		}

		//vote answer
		$scope.voteAnswer = function(answer_id){
			$http.post('/questions/api/answer/vote',{answer_id:answer_id,isVoted:this.answers.voted[answer_id]})
	 			 .then(function(response){
	 			 	console.log('Vote answer: ',response);
	 			 	if (response.data == 1) {
	 			 		$scope.answers.voted[answer_id] = 1;
	 			 		$scope.answers.voteCount[answer_id]++;
	 			 	} else if (response.data == 0){
	 			 		$scope.answers.voted[answer_id] = 0;
	 			 		$scope.answers.voteCount[answer_id]--;
	 			 	}
	 			 },function(error){
	 			 	console.log(error);
	 		 });
		}

		$scope.comments = function(answer_id) {
			$scope.comment_box_id = answer_id;
		}

		//add new comment
		$scope.addComment = function(answer_id) {

			$http.post('/questions/api/answer/comment-add',{answer_id:answer_id,content:this.comment_content})
	 			 .then(
	 			 	function(response){
		 			 	console.log('Add new comment: ',response.data);
		 			 	$scope.answers.commentCount[answer_id]++;
		 			 	$scope.answers.comments[answer_id].comments.push(response.data);
		 			 	setNewCommentDefault(response.data.id,answer_id);
		 			 	$scope.comment_content="";
	 			 	}
	 			 	,function(error){
	 			 		console.log(error);
	 		});
		}

		$scope.voteComment = function(comment_id, answer_id) {
			$http.post('/questions/api/answer/comment/vote',{comment_id:comment_id,isVoted:this.answers.comments[answer_id].voted[comment_id]})
	 			 .then(
	 			 	function(response){
	 			 		console.log('Vote comment:',response);
	 			 		$scope.answers.comments[answer_id].voted[comment_id] = response.data;
	 			 		if (response.data == 1) {
	 			 			$scope.answers.comments[answer_id].voteCount[comment_id]++;
	 			 		} else {
	 			 			$scope.answers.comments[answer_id].voteCount[comment_id]--;
	 			 		}
	 			 	}
	 			 	,function(error){
	 			 	console.log(error);
	 		});
		}

		$scope.showCommentDropMenu = function(comment_id) {
			$scope.comment_menu_id = comment_id;
		}
	 });

})();