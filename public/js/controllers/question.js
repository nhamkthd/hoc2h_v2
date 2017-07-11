(function(){
	'use strict';
	var app = angular.module('hoc2h-question', []);

	app.run(['$anchorScroll', function($anchorScroll) {
  		$anchorScroll.yOffset = 50;   // always scroll by 50 extra pixels
	}]);
	app.config(['$qProvider', function ($qProvider) {
   	 $qProvider.errorOnUnhandledRejections(false);
	}]);
	//app services
	app.factory('questionService',function(){
		var questionService = {};

    	return questionService;
	});
	
	//show limit line content filter
	app.filter('textShortenerFilter', function() {
	  return function(text, length) {
	    if (text.length > length) {
	      return text.substr(0, length) + "...";
	    }
	    return text;
	  }
	});

    //question-list-card directive
	app.directive('questionCard',function(){
		return {
			restrict:'E',
			templateUrl:'/questions/question-card',
		}	
	});
	//confirm delete driective
	app.directive('confirmDelete', [function () {
        return {
            priority: 100,
            restrict: 'A',
            link: {
                pre: function (scope, element, attrs) {
                    var msg = attrs.confirm || "Bạn thật sự muốn xoá?";

                    element.bind('click', function (event) {
                        if (!confirm(msg)) {
                            event.stopImmediatePropagation();
                            event.preventDefault;
                        }
                    });
                }
            }
        };
    }]);

	//enter submit directive (shift+enter => next line)
	app.directive('enterSubmit', function () {
	    return {
	      restrict: 'A',
	      link: function (scope, elem, attrs) {
	       
	        elem.bind('keydown', function(event) {
	          var code = event.keyCode || event.which;    
	          if (code === 13) {
	            if (!event.shiftKey) {
	              event.preventDefault();
	              scope.$apply(attrs.enterSubmit);
	            }
	          }
	        });
	      }
	    }
  	});

	//main question controller
	app.controller('QuestionController',function($scope, $http,$sce){
		$scope.tab = 1;
	 	$scope.setSelectedTab = function(sTab){
	 		$scope.tab = sTab;
	 	}
	 	$scope.getQuestionsWithTab = function(tab){
	 		console.log(tab);
	 		if (tab == 1) {
	 			$http.get('/questions/api/')
	 			 .then(function(response){
	 			 		console.log(response.data);
	 			 		$scope.questions  = response.data;
	 			 	}, function(error){

	 			 });
	 		}
	 	}
	 	
	});

	app.controller('CreateQuestionController',function($scope,$http){
		$scope.tags = [];
		$scope.getTags = function() {
	 		$http.get('/tags')
	 			 .then(function(response){
	 			 		console.log(response.data);
	 			 		$scope.loadTags = response.data;
	 			 	}, function(error){
	 		});
	 	}
	});
	//Question detail controller
	app.controller('QuestionDetailController',function($http,$scope,$sce,$filter,$anchorScroll,$location,$uibModal){
		this.animationsEnabled = true;
	 	$scope.showComments = [];
	 	$scope.edit_answer_content = [];
	 	$scope.comment_content_field = [];
	 	$scope.comment_editing = [];
	 	$scope.comment_editing_field = [];
	 	//auto scroll
		$scope.gotoAnchor = function(x) {
	      	var newHash = 'anchor' + x;
	      	if ($location.hash() !== newHash) {
	        	$location.hash('anchor' + x);
	      	} else {
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
	 		$http.post('/questions/api/getQuestionInfo',{id:question_id})
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
		$scope.options = {
		    language: 'vn',
		    allowedContent: true,
		    entities: false
		  };

		//update question when updated 
		var updateQuestion = function(newQuestion){
			$scope.question.title = newQuestion.title;
			$scope.question.content =newQuestion.content;
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

		$scope.editQuestion = function(){

			$uibModal.open({
	            templateUrl: 'editQuestionModal.html', // loads the template
	            backdrop: true, // setting backdrop allows us to close the modal window on clicking outside the modal window
	            windowClass: 'modal', // windowClass - additional CSS class(es) to be added to a modal window template
	            controller: function ($scope, $uibModalInstance,question,$log) {
	                $scope.title_edit = question.title;
					$scope.edit_question_content = question.content;
	                $scope.submit = function () {
	                   	$http.post('/questions/api/edit',{id:question.id,title:$scope.title_edit,content:$scope.edit_question_content})
				 			 .then(function(response){
				 			 	console.log('Edit question: ',response);
				 			 	question.content = response.data.content;
				 			 	question.title = response.data.title;
				 			 },function(error){
				 			 	console.log(error);
				 		 });
	                    $uibModalInstance.dismiss('cancel'); // dismiss(reason) - a method that can be used to dismiss a modal, passing a reason
	                }
	                $scope.cancel = function () {
	                    $uibModalInstance.dismiss('cancel'); 
	                };
	            },
	            resolve: {
	                question: function () {
	                    return $scope.question;
	                }
	            }
	        });//end of modal.open
		}

		$scope.deleteQuestion = function(){
			$uibModal.open({
	            templateUrl:'deleteQuestionModal.html', // loads the template
	            backdrop: true, // setting backdrop allows us to close the modal window on clicking outside the modal window
	            windowClass: 'modal', // windowClass - additional CSS class(es) to be added to a modal window template
	            controller: function ($scope, $uibModalInstance) {
	                $scope.submit = function () {
	       //          	$http.post('/questions/api/delete',{id:question.id})
				 			//  .then(function(response){
				 			//  	consolole.log('deleted question:',response);
				 			 	
				 			//  },function(error){
				 			//  	console.log(error);
				 		 // });
	                    $uibModalInstance.dismiss('cancel');//dismiss modal
	                }
	                $scope.cancel = function () {
	                    $uibModalInstance.dismiss('cancel'); 
	                };
	            },
	            resolve: {
	             	
	            }
	        });//end of modal.open
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
			$http.post('/questions/api/answers/',{question_id:$scope.question.id,content:$scope.answer_content_field})
	 			 .then(function(response){
	 			 	console.log('Add new answer: ',response.data);
	 			 	var newAnswer = response.data;
	 			 	$scope.question.answers.push(newAnswer);
	 			 	$scope.answer_count++;
	 			 	setNewAnswerDefault(newAnswer.id);
	 			 	console.log($scope.answers);
	 			 	$scope.answer_content_field = " ";
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

		$scope.editAnswer = function(index) {
			$uibModal.open({
	            templateUrl: 'editAnswerModal.html', // loads the template
	            backdrop: true, // setting backdrop allows us to close the modal window on clicking outside the modal window
	            windowClass: 'modal', // windowClass - additional CSS class(es) to be added to a modal window template
	            controller: function ($scope, $uibModalInstance,question) {
					$scope.edit_answer_content = question.answers[index].content;
	                $scope.submit = function () {
	                   	$http.post('/questions/api/answer/edit',{id:question.answers[index].id,content:$scope.edit_answer_content})
				 			 .then(
				 			 	function(response){
					 			 	console.log('Edit answer: ',response);
					 			 	question.answers[index].content = response.data.content;
				 			 	}
				 			 	,function(error){
				 			 		console.log(error);
				 		});
	                    $uibModalInstance.dismiss('cancel'); // dismiss
	                }
	                $scope.cancel = function () {
	                    $uibModalInstance.dismiss('cancel'); 
	                };
	            },
	            resolve: {
	                question: function () {
	                    return $scope.question;
	                }
	            }
	        });//end of modal.open
		}
		var updateAnswerCount = function(){
			$scope.answer_count --;
		}
		$scope.deleteAnswer = function(index){

			$uibModal.open({
	            templateUrl: 'deleteAnswerModal.html', // loads the template
	            backdrop: true, // setting backdrop allows us to close the modal window on clicking outside the modal window
	            windowClass: 'modal', // windowClass - additional CSS class(es) to be added to a modal window template
	            controller: function ($scope, $uibModalInstance,question) {
					$scope.edit_answer_content = question.answers[index].content;
	                $scope.submit = function () {
	                   	$http.post('/questions/api/answer/delete',{id:question.answers[index].id})
				 			 .then(
				 			 	function(response){
					 			 	console.log('delete answer: ',response);
					 			 	question.answers.splice(index,1);
					 			 	updateAnswerCount();
				 			 	}
				 			 	,function(error){
				 			 		console.log(error);
				 		});
	                    $uibModalInstance.dismiss('cancel'); // dismiss
	                }
	                $scope.cancel = function () {
	                    $uibModalInstance.dismiss('cancel'); 
	                };
	            },
	            resolve: {
	                question: function () {
	                    return $scope.question;
	                }
	            }
	        });//end of modal.open
		}

		$scope.showComments = function(answer_id){
			$scope.showComments[answer_id] = !$scope.showComments[answer_id];
		}

		//add new comment
		$scope.addComment = function(index,answer_id) {
			var comment_content = $scope.comment_content_field[index];
			$http.post('/questions/api/answer/comment-add',{answer_id:answer_id,content:comment_content})
	 			 .then(
	 			 	function(response){
		 			 	console.log('Add new comment: ',response.data);
		 			 	$scope.answers.commentCount[answer_id]++;
		 			 	$scope.answers.comments[answer_id].comments.push(response.data);
		 			 	setNewCommentDefault(response.data.id,answer_id);
		 			 	$scope.comment_content_field[index]="";
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
		$scope.editCommentMode = function(index,answer_id) {
			console.log('editing comment....');
			$scope.comment_editing[index] = 1;
			$scope.comment_editing_field[index] = $scope.answers.comments[answer_id].comments[index].content;
		}
		$scope.cancelEditComment = function(index) {
			console.log('cancel edit comment....');
			$scope.comment_editing[index] = 0;
		}

		$scope.editComment = function(index, answer_id){
			var comment_id = $scope.answers.comments[answer_id].comments[index].id;
			var comment_content = $scope.comment_editing_field[index];
			$http.post('/questions/api/answer/comment/edit',{id:comment_id,content:comment_content})
	 			 .then(
	 			 	function(response){
		 			 	console.log('Edit comment: ',response);
		 			 	$scope.answers.comments[answer_id].comments[index].content = response.data.content;
		 			 	$scope.comment_editing[index] = 0;
	 			 	}
	 			 	,function(error){
	 			 		console.log(error);
	 		});
		}

		$scope.deleteComment = function(index,answer_id){
			var comment_id = $scope.answers.comments[answer_id].comments[index].id;
			$http.post('/questions/api/answer/comment/delete',{id:comment_id})
	 			 .then(
	 			 	function(response){
	 			 		console.log('Delete comment:',response);
	 			 		$scope.answers.comments[answer_id].comments.splice(index,1);
	 			 	}
	 			 	,function(error){
	 			 	console.log(error);
	 		});
		}
	 });

})();