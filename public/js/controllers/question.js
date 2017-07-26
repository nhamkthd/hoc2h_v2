(function(){
	'use strict';
	var app = angular.module('hoc2h-question', ['infinite-scroll']);
	
	app.run(['$anchorScroll', function($anchorScroll) {
  		$anchorScroll.yOffset = 50;   // always scroll by 50 extra pixels
	}]);
	app.config(['$qProvider', function ($qProvider) {
   	 $qProvider.errorOnUnhandledRejections(false);
	}]);
	//category service
 	app.factory('Categories', function($http,$q) {
 		return {
 			getList:function(){
 				var deferred = $q.defer();
 				$http.get('/categories/api/')
 					 .then(function(response){
 					 	deferred.resolve(response);
 					 },function (error) {
 					 	deferred.reject();
 					 	console.log(error);
 					 });
 				return deferred.promise;
 			}
 		}
	}); 
	//tags service
	app.factory('Tags', function($http, $q) {
		return {
 			getList:function(){
 				var deferred = $q.defer();
 				$http.get('/tags')
 					 .then(function(response){
 					 	deferred.resolve(response);
 					 },function (error) {
 					 	deferred.reject();
 					 	console.log(error);
 					 });
 				return deferred.promise;
 			}
 		}
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
	app.controller('QuestionController',function($scope, $http,$sce,Tags){
		var tag_id = 0;
		$scope.tab = 1;
	 	$scope.setSelectedTab = function(sTab){
	 		$scope.tab = sTab;
	 		switch(sTab){
	 			case 1:
	 				$scope.tab_name = "Mới nhất";
	 				break;
	 			case 2:
	 				$scope.tab_name = "Nổi bật";
	 				break;
	 			case 3:
	 				$scope.tab_name = "Nổi bật trong tuần";
	 				break;
	 			case 4:
	 				$scope.tab_name = "Câu hỏi của bạn";
	 				break;
	 			case 5:
	 				$scope.tab_name = "Đang theo dõi";
	 				break;
	 			case 6:
	 				$scope.tab_name = "Đã được giải quyết";
	 				break;
	 			case 7:
	 				$scope.tab_name = "Chưa được giải quyết";
	 				break;
	 			case 8:
	 				$scope.tab_name = "chưa có câu trả lời";
	 				break;
	 			case 9:
	 				$scope.tab_name = "Thành viên tiêu biểu";
	 				break;

	 		}
	 	}
	 	$scope.getListTags = function (){
	 		$http.get('/tags')
 				 .then(function(response){
 					 $scope.sidebarTags = response.data;
 					 console.log("sidebarTags: ",$scope.sidebarTags);
 				},function (error) {
 					console.log(error);
 				});
	 	}
	 	$scope.getQuestionsWithTab = function(tab){
	 		$http.get('/questions/api/?filtertab='+$scope.tab)
	 			 .then(function(response){
	 			 	console.log(response.data);
	 			 	$scope.questions  = response.data;
	 			 }, function(error){
	 			 	console.log(error);
	 		});
	 	}

	 	$scope.getQuestionsTagged = function(tag_id){
	 		this.tag_id = tag_id;
	 		$http.get('/questions/api/tagged/'+tag_id)
	 			 .then(function(response){
	 			 	$scope.questions  = response.data;
	 			 },function(error){
	 			 	console.log(error);
	 			 });
	 	}
	 	//questions searching....!
	 	$scope.search = function(){
	 		if ($scope.keywords === '' || typeof $scope.keywords === 'undefined') {
	 			if ($scope.tab == 0) {
	 				this.getQuestionsTagged(this.tag_id);
	 			} else {
	 				$http.get('/questions/api/?filtertab='+$scope.tab)
		 			 .then(function(response){
		 			 	console.log(response.data);
		 			 	$scope.questions  = response.data;
		 			 }, function(error){
		 			 	console.log(error);
		 			});
		 		}
	 		} else {
	 			$http.get('/questions/api/search?keyword='+$scope.keywords)
	 			 .then(function(response){
	 			 	$scope.questions = response.data.data;
	 			 },function(error){
	 			 	console.log(error);
	 			 });
	 		}
	 	}
	});

	//create question controller
	app.controller('CreateQuestionController',function($scope,$http,Categories,Tags){
		$scope.tagsList = [];
		$scope.questions_related = [];
		Categories.getList().then(function(response){$scope.categories = response.data;});
		Tags.getList().then(function(response){$scope.tags = response.data;});
		
		//fiding question related with title key words
		$scope.findRelated = function(){
			if ($scope.title === ''|| typeof $scope.title === 'undefined') {
				$scope.questions_related = [];
			}else {
				$http.get('/questions/api/search-related?keyword='+$scope.title)
	 			 .then(function(response){
	 			 	$scope.questions_related = response.data.data;
	 			 },function(error){
	 			 	console.log(error);
	 			 });
			}
		}

	 	$scope.submitQuestion = function(){
	 		console.log($scope.tagsList);
	 		$http.post('/questions/api/store',{category:$scope.category_id, title:$scope.title, content:$scope.content,tags:$scope.tagsList})
	 			 .then(function(response){
	 			 	console.log(response.data)
	 			 	window.location.href = '/questions/question/'+response.data.id;
	 			 },function(error){
	 			 	console.log(error);
	 			 });
	 	}
	});
	//Question detail controller
	app.controller('QuestionDetailController',function($http,$scope,$sce,$filter,$anchorScroll,$location,$uibModal,Tags){
		this.animationsEnabled = true;
		$scope.isQuestionNotFound = 0;
		$scope.isLogged = false;
	 	$scope.showComments = [];
	 	$scope.edit_answer_content = [];
	 	$scope.comment_content_field = [];
	 	$scope.comment_editing = [];
	 	$scope.comment_editing_field = [];
	 	Tags.getList().then(function(response){$scope.tags = response.data;});
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
        
        $scope.questionNotFound = function(){
        	$scope.isQuestionNotFound = 1;
        }

        $scope.getUser = function(user) {
        	$scope.user = user;
        	$scope.isLogged = true;
        }
        //init question form route
	 	$scope.initQuestion = function (question_id) {
	 		$scope.question ={};
	 		$scope.answers = [];
	 		$scope.isResolved = 0;
	 		$http.post('/questions/api/getQuestionInfo',{id:question_id})
	 			 .then(function(response){
	 			 	console.log('Init question: ',response.data);
	 			 	$scope.question = response.data.question;
	 			 	$scope.isResolved = $scope.question.is_resolved;
	 			 	$scope.question_votes = $scope.question.votes.length;
					$scope.isVotedQuestion = response.data.isVoted;
					$scope.answers = response.data.answers;
					$scope.answer_count = $scope.question.answers.length;
					$scope.tagsList = response.data.tagsList;
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
	 			 	var data = response.data;
	 			 	if (data == 1) {$scope.question_votes++; $scope.isVotedQuestion = data;}
	 			 	else if(data == 0){$scope.question_votes--; $scope.isVotedQuestion = data;}
	 			 	else if (data == -1) {
	 			 		window.location.href = '/login';
	 			 	}
	 			 },function(error){
	 			 	console.log(error);
	 		 });

		}

		//change resolve state 
		$scope.changeResolve = function(param) {
			$http.post('/questions/api/change-resolve',{question_id:$scope.question.id,param:param})
	 			 .then(function(response){
	 			 	console.log('change resolve: ',response.data);
	 			 	$scope.isResolved = response.data;	
	 			 },function(error){
	 			 	console.log(error);
	 		});
		}

		//change category
		$scope.editCategory = function() {
			$uibModal.open({
	            templateUrl: 'editQuestionCategoryModal.html', // loads the template
	            backdrop: true, // setting backdrop allows us to close the modal window on clicking outside the modal window
	            windowClass: 'modal', // windowClass - additional CSS class(es) to be added to a modal window template
	            controller: function ($scope, $uibModalInstance,$log,Categories,question) {
	              	Categories.getList().then(function(response){$scope.categories = response.data;});
	                $scope.submit = function () {
	                   	$http.post('/questions/api/editCategory',{id:question.id,category:$scope.category_edit})
				 			 .then(function(response){
				 			 	console.log('Edit question category: ',response.data)
				 			 	question.category = response.data;
				 			 },function(error){
				 			 	console.log(error);
				 		 });
	                    $uibModalInstance.dismiss('cancel'); // dismiss(reason) 
	                }
	                $scope.cancel = function () {
	                    $uibModalInstance.dismiss('cancel'); 
	                };
	            },
	            resolve: {
	                question:function(){
	                	return $scope.question;
	                }
	            }
	        });//end of modal.open
		}

		//question add new tags
		$scope.addNewTags = function (){
			$http.post('/questions/api/add-Tags',{question_id:$scope.question.id,tags:$scope.newTagsList})
	 			 .then(function(response){
	 			 	console.log('add tags: ',response.data);
	 			 	$scope.tagsList = response.data;	
	 			 },function(error){
	 			 	console.log(error);
	 		});
		}

		//edit question
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

		//delete question
		$scope.deleteQuestion = function(id){
			$uibModal.open({
	            templateUrl:'deleteQuestionModal.html', // loads the template
	            backdrop: true, // setting backdrop allows us to close the modal window on clicking outside the modal window
	            windowClass: 'modal', // windowClass - additional CSS class(es) to be added to a modal window template
	            controller: function ($scope, $uibModalInstance) {
	                $scope.submit = function () {
	                	$http.post('/questions/api/delete',{id:id})
				 			 .then(function(response){
				 			 	window.location.href = '/questions';
				 			 },function(error){
				 			 	console.log(error);
				 		 });
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
	 			 	if (response.data == -1) {
	 			 		window.location.href = '/login';
	 			 	} else {
	 			 		var newAnswer = response.data;
	 			 		newAnswer.date_created = "Vừa xong";
		 			 	$scope.question.answers.push(newAnswer);
		 			 	$scope.answer_count++;
		 			 	setNewAnswerDefault(newAnswer.id);
		 			 	console.log($scope.answers);
		 			 	$scope.answer_content_field = " ";
	 			 	}
	 			 	
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
	 			 	} else if (response.data == -1) {
	 			 		window.location.href = '/login';
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
		 			 	if (response.data != -1) {
		 			 		$scope.answers.commentCount[answer_id]++;
		 			 		response.data.date_created = "Vừa xong";
		 			 		$scope.answers.comments[answer_id].comments.push(response.data);
		 			 		setNewCommentDefault(response.data.id,answer_id);
		 			 		$scope.comment_content_field[index]="";
		 			 	}
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
	 			 		if (response.data == -1) {window.location.href = '/login';}
	 			 		else if (response.data == 1) {
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