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
 	app.directive('postsPaginations', function(){
 		return {
 			restrict: 'E',
 			template: '<ul class="pagination">'+
 			'<li><a ng-class="{disabled:currentPage == 1}" ng-click="getQuestionsWithTab(1)">«</a></li>'+
 			'<li><a ng-class="{disabled:currentPage == 1}" ng-click="getQuestionsWithTab(currentPage-1)">‹</a></li>'+
 			'<li ng-repeat="i in range" ng-class="{active : currentPage == i}">'+
 			'<a ng-click="getQuestionsWithTab(i)">{{i}}</a>'+
 			'</li>'+
 			'<li><a ng-class="{disabled:currentPage == totalPages}" href="" ng-click="getQuestionsWithTab(currentPage+1)"> ›</a></li>'+
 			'<li><a ng-class="{disabled:currentPage == totalPages}" href="" ng-click="getQuestionsWithTab(totalPages)">»</a></li>'+
 			'</ul>'
 		};
 	});

	//get tags list service
	app.factory('Tags', function($http, $q) {
		return {
 			getList:function($category_id){
 				if ($category_id == null) {
 					$category_id = 0;
 				}
 				var deferred = $q.defer();
 				$http.get('/tags/'+$category_id)
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

	//show limit text filter
	app.filter('textShortenerFilter', function() {
	  return function(text, length) {
	  	var string = text ? String(text).replace(/<[^>]+>/gm, '') : '';//out put plain text...
	    if (string.length > length) {
	      return string.substr(0, length) + "...";
	    }
	    return string;
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

	//--------------------------------------------MAIN QUESTION CONTROLLER--------------------------------------------//
	app.controller('QuestionController',function($scope, $http,$anchorScroll,$location,$sce,Tags,Categories,cfpLoadingBar){
		//init params
		var tag_id = 0;
		$scope.tab = 1;
		$scope.totalPages = 0;
	 	$scope.currentPage = 1;
	 	$scope.isLoaded = 0;
	 	$scope.range = [];
	 	//get categories list
	 	Categories.getList().then(function(response){$scope.categories = response.data;});

	 	//set tab selected
	 	$scope.setSelectedTab = function(sTab){
	 		$scope.tab = sTab;
	 		if (sTab == 3  ) {
	 			$scope.isPaginate = false;
	 		} else {
	 			$scope.isPaginate = true;
	 		}
	 		switch(sTab){
	 			case 1:
	 				$scope.tab_name = "Mới nhất";
	 				break;
	 			case 2:
	 				$scope.tab_name = "Nổi bật nhất";
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
	 	//get tags list with category id
	 	$scope.getListTags = function(param){
	 		Tags.getList(param).then(function(response){$scope.sidebarTags = response.data;});
	 	}

	 	//filter tags list with category id
	 	$scope.changeCategory = function (newValue) {
	 		if (newValue) {
	 			$scope.getListTags(newValue.id);
	 		} else {
	 			$scope.getListTags(0);
	 		}
	 	}

	 	$scope.getListTagsWithQuestionCategory = function(category_id){
	 		$scope.getListTags(category_id);
	 		$scope.tags_category_id = category_id;
	 		console.log($scope.tags_category_id);
	 	}

	 	//get questions list with sort tab ID
	 	$scope.getQuestionsWithTab = function(pageNumber){
	 		$scope.isLoaded = 0;
	 		$http.get('/questions/api/?filtertab='+$scope.tab+ '&page=' + pageNumber)
	 		.then(function(response){
	 			$location.hash('top');
      			$anchorScroll();
      			console.log(response.data);
      			$scope.total=response.data.total;
      			$scope.maxPage=response.data.last_page;
      			$scope.questions = response.data.data;
      			$scope.currentPage  = response.data.current_page;
      			$scope.totalPages   = response.data.last_page;
      			var pages = [];
      			for (var i = 1; i <= response.data.last_page; i++) {
      				pages.push(i);
      			}
      			$scope.range = pages;
      			
      			$scope.isLoaded = 1;
	 		}, function(error){
	 			console.log(error);
	 		});
	 	}
	 	//get questions list with tag id
	 	$scope.getQuestionsTagged = function(tag_id,pageNumber){

	 		this.tag_id = tag_id;
	 		console.log('get questions with tag_id = ',tag_id);
	 		$http.get('/questions/api/tagged/'+tag_id+ '?page=' + pageNumber)
	 			 .then(function(response){
	 			 	$location.hash('top');
      			  	$anchorScroll();
	 			 	console.log(response.data);
	 			 	$scope.total=response.data.total;
	 				$scope.maxPage=response.data.last_page;
	 				$scope.questions = response.data.data;
	 				$scope.currentPage  = response.data.current_page;
	 				$scope.totalPages   = response.data.last_page;
		 			var pages = [];
		 			for (var i = 1; i <= response.data.last_page; i++) {
		 				pages.push(i);
		 			}
		 			$scope.range = pages;
	 			 },function(error){
	 			 	console.log(error);
	 			 });
	 	}

	 	//get list question related
	 	$scope.getQuestionRelated = function(question_id){
	 		$http.get('/questions/api/related/'+question_id)
	 			 .then(function(response){
	 			 	$scope.related_questions = response.data;
	 			 	console.log('related_questions:',$scope.related_questions);
	 			 },function(error){console.log(error.data);})
	 	}

	 	//questions searching....!
	 	$scope.search = function(){
	 		if ($scope.keywords === '' || typeof $scope.keywords === 'undefined') {
	 			if ($scope.tab == 0) {
	 				this.getQuestionsTagged(this.tag_id);
	 			} else {
	 				$scope.getQuestionsWithTab($scope.tab,1);
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


	//--------------------------------------------CREATE QUESTION CONTROLLER--------------------------------------------//
	app.controller('CreateQuestionController',function($scope,$http,Categories,Tags){
		$scope.tagsList = [];
		$scope.questions_related = [];

		Categories.getList().then(function(response){$scope.categories = response.data;});
		
		$scope.changeCategory = function(newValue){
			if (newValue) {
				Tags.getList(newValue.id).then(function(response){$scope.tags = response.data;});
			} else {
				$scope.tags = [];
			}
		}
	
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
	
	//--------------------------------------------SHOW QUESTION DETAIL CONTROLLER--------------------------------------------//
	app.controller('QuestionDetailController',function($http,$scope,$sce,$filter,$anchorScroll,$location,$uibModal,Tags){

		this.animationsEnabled = true;
		$scope.isQuestionNotFound = 0;
		$scope.isLogged = false;
	 	$scope.showComments = [];
	 	$scope.edit_answer_content = [];
	 	$scope.answer_page_number = 2;
	 	$scope.comment_content_field = [];
	 	$scope.comment_editing = [];
	 	$scope.comment_editing_field = [];
	 	$scope.sendAnswerText = "Gửi đi";

	 	//auto scroll
		$scope.gotoAnchor = function(x) {
	      	var newHash = 'anchor' + x;
	      	if ($location.hash() !== newHash) {
	        	$location.hash('anchor' + x);
	      	} else {
	        	$anchorScroll();
	      	}
	      	$scope.anchorAt = x;
	    };

	    $scope.gotoCommentAnchor = function(x) {
	    	var newHash = 'anchorComment' + x;
	      	if ($location.hash() !== newHash) {
	        	$location.hash('anchorComment' + x);
	      	} else {
	        	$anchorScroll();
	      	}
	      	$scope.anchorCommentAt = x;
	    }

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
        	console.log('user is logged...',$scope.isLogged);
        }

        //init question infomation with ID
	 	$scope.getQuestionInfo = function (question_id,answer_id,comment_id) {
	 		$scope.question = {};
	 		$scope.answers = [];
	 		$scope.related_questions = {};
	 		$scope.isResolved = 0;
	 		//get question infomation
	 		$http.get('/questions/api/question-detail/'+question_id+'/'+answer_id+'/'+comment_id)
	 			 .then(function(response){
	 			 	console.log('Init question: ',response.data);
	 			 	$scope.question = response.data;
	 			 	Tags.getList($scope.question.category_id).then(function(response){$scope.tags = response.data;});
	 			 	$scope.getFirstAnswerPage();
	 			 	if (answer_id > 0) {
	 			 		if (comment_id > 0) {
	 			 			$scope.showComments(answer_id);
	 			 			$scope.gotoCommentAnchor(comment_id);
	 			 		} else {
	 			 			$scope.gotoAnchor(answer_id);
	 			 		}
	 			 	}
	 			 },function(error){
	 			 	console.log(error);
	 		 });
		}
		
		$scope.getFirstAnswerPage = function() {
			$http.get('/questions/api/answers/question-id/'+$scope.question.id)
	 			 .then(function(response){
	 			 	$scope.answers = response.data.data;
	 			 	console.log('answers:',$scope.answers);
	 			 	$scope.answers_count= response.data.total;
	 			 	$scope.last_answer_page = response.data.last_page;
	 			 	if ($scope.question.currentAnswerPage > 1) {
	 			 		console.log('currentAnswerPage: ',$scope.question.currentAnswerPage);
	 			 		$scope.current_answer_page = $scope.question.currentAnswerPage - 1;
	 			 		$scope.loadMoreAnswers()
	 			 	}else{
	 			 		$scope.current_answer_page = 1;
	 			 	}
	 			},function(error){
	 				console.log(error.data)
	 		});
		}

		$scope.loadMoreAnswers = function() {
			console.log($scope.last_answer_page);
			if ($scope.last_answer_page > $scope.current_answer_page) {
	 			$scope.current_answer_page++;
	 			console.log($scope.maxpageAnswer);
	 		}else {
	 			return;
	 		}
			$scope.isloadingQa = 1;
			$http.get('/questions/api/answers/question-id/'+$scope.question.id+'?page='+$scope.current_answer_page)
	 			 .then(function(response){
	 			 	for (var i = 0; i < response.data.data.length; i++) {
	 			 		$scope.answers.push(response.data.data[i]);
	 			 	}
	 			 	$scope.total= response.data.total;
	 			 	$scope.isloadingQa=0;
	 		});
		}

		//check user is online
		$scope.authorIsOnline = function(param){
			$scope.question_author_isOnline = param;
			console.log('author is online...',param);
		}
		
		//update question when updated 
		var updateQuestion = function(newQuestion){
			$scope.question.title = newQuestion.title;
			$scope.question.content =newQuestion.content;
		}
		//vote question
		$scope.voteQuestion = function(){
			ignoreLoadingBar: true
			$scope.isVoting = 1;
			$http.post('/questions/api/vote',{question_id:$scope.question.id,isVoted:$scope.question.isVoted})
	 			 .then(function(response){
	 			 	console.log('Vote question: ',response);
	 			 	var data = response.data;
	 			 	if (data == 1) {$scope.question.votes_count++; $scope.question.isVoted = data;}
	 			 	else if(data == 0){$scope.question.votes_count--; $scope.question.isVoted = data;}
	 			 	else if (data == -1) {
	 			 		window.location.href = '/login';
	 			 	}
	 			 	$scope.isVoting = 0;
	 			 },function(error){
	 			 	console.log(error);
	 		 });

		}

		//change resolve state 
		$scope.changeResolve = function(param) {
			ignoreLoadingBar: true;
			$http.post('/questions/api/change-resolve',{question_id:$scope.question.id,param:param})
	 			 .then(function(response){
	 			 	console.log('change resolve: ',response.data);
	 			 	$scope.question.is_resolved = response.data;
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
	              	$scope.category_edit = question.category.id;
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

		//requestion answer
		$scope.requestAnswer = function(){
			$uibModal.open({
	            templateUrl: 'requestModal.html', // loads the template
	            backdrop: true, // setting backdrop allows us to close the modal window on clicking outside the modal window
	            windowClass: 'modal', // windowClass - additional CSS class(es) to be added to a modal window template
	            controller: function ($scope, $uibModalInstance,$log,question,user) {

	              	$http.get('/users/api/all-users')
			 		   .then(function(response){$scope.users = response.data;console.log($scope.users);}
			 				,function(error){console.log(error.data);});
			 		$scope.question = question;
			 		$scope.donating = function(){
			 			if ($scope.donate_coins > $scope.question.user.coin) {
			 				$scope.isCannotDonate = 1;
			 			}else {
			 				$scope.isCannotDonate = 0;
			 			}
			 		}
	                $scope.submit = function () {
	                   	$http.post('/questions/api/request-answer',{question_id:question.id,
	                   											    requester_id:user.id,
	                   											    user_id:$scope.question_requested_user
	                   											    ,donate_coins:$scope.donate_coins})
				 			 .then(function(response){
				 			 	console.log('request answer: ',response.data)
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
	                },
	                user:function(){
	                	return $scope.user;
	                }
	            }
	        });//end of modal.open
		}

		//question add new tags
		$scope.addNewTags = function (){
			$http.post('/questions/api/add-Tags',{question_id:$scope.question.id,tags:$scope.newTagsList})
	 			 .then(function(response){
	 			 	console.log('add tags: ',response.data);
	 			 	$scope.question.tagsList = response.data;	
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

		//ad new answer
		$scope.addAnswer = function(){
			ignoreLoadingBar: true;
			$scope.sendAnswerText = "Sending";
			$http.post('/questions/api/answers',{question_id:$scope.question.id,content:$scope.answer_content_field})
	 			 .then(function(response){
	 			 	console.log('Add new answer: ',response.data);
	 			 	if (response.data == -1) {
	 			 		window.location.href = '/login';
	 			 	} else {
	 			 		
	 			 		var newAnswer = response.data;
	 			 		console.log("add new answer success...!",newAnswer);
	 			 		newAnswer.date_created = "Vừa xong";
		 			 	$scope.answers.push(newAnswer);
		 			 	$scope.answers_count++;
		 			 	console.log($scope.answers);
		 			 	$scope.answer_content_field = " ";
		 			 	$scope.sendAnswerText = "Gửi đi";
	 			 	}
	 			 	
	 			 },function(error){
	 			 	console.log(error);
	 		 });
		}

		//vote answer
		$scope.voteAnswer = function(index){

			$http.post('/questions/api/answer/vote',{answer_id:$scope.answers[index].id,isVoted:$scope.answers[index].isVoted})
	 			 .then(function(response){
	 			 	console.log($scope.answers[index]);
	 			 	console.log('Vote answer: ',response);
	 			 	if (response.data == 1) {
	 			 		$scope.answers[index].isVoted = 1;
	 			 		$scope.answers[index].votes_count++;
	 			 		if (index == $scope.question.bestAnswer.index) {
	 			 			$scope.question.bestAnswer.isVoted = 1;
	 			 			$scope.question.bestAnswer.votes_count++;
	 			 		}
	 			 	} else if (response.data == 0){
	 			 		$scope.answers[index].isVoted = 0;
	 			 		$scope.answers[index].votes_count--;
	 			 		if (index == $scope.question.bestAnswer.index) {
	 			 			$scope.question.bestAnswer.isVoted = 0;
	 			 			$scope.question.bestAnswer.votes_count--;
	 			 		}
	 			 	} else if (response.data == -1) {
	 			 		window.location.href = '/login';
	 			 	}
	 			 },function(error){
	 			 	console.log(error);
	 		 });
		}

		//set best answer 
		$scope.setBestAnswer = function(index,param){
			$http.post('/questions/api/answer/set-best',{answer_id:$scope.answers[index].id,is_best:param})
				 .then(function(response){
				 	$scope.answers[index].is_best = response.data;
				 	console.log('set best answer:',$scope.answers[index].is_best);
				 	if (response.data == 0) {
				 		$scope.question.bestAnswer = null;
				 	}else {
				 		$scope.question.bestAnswer = $scope.answers[index];
				 		$scope.question.bestAnswer.index = index;
				 	}
				 },function(error){
				 	console.log(error.data);
				 });
		}
		//edit answer
		$scope.editAnswer = function(index) {
			$uibModal.open({
	            templateUrl: 'editAnswerModal.html', // loads the template
	            backdrop: true, // setting backdrop allows us to close the modal window on clicking outside the modal window
	            windowClass: 'modal', // windowClass - additional CSS class(es) to be added to a modal window template
	            controller: function ($scope, $uibModalInstance,answers,question) {
					$scope.edit_answer_content = answers[index].content;
	                $scope.submit = function () {
	                   	$http.post('/questions/api/answer/edit',{id:answers[index].id,content:$scope.edit_answer_content})
				 			 .then(
				 			 	function(response){
					 			 	console.log('Edit answer: ',response);
					 			 	answers[index].content = response.data.content;
					 			 	if (index == question.bestAnswer.index) {
					 			 		question.bestAnswer.content = response.data.content;
					 			 	}
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
	                question:function(){
	                	return $scope.question;
	                },
	                answers:function(){
	                	return $scope.answers;
	                }
	            }
	        });//end of modal.open
		}

		//delete answer
		$scope.deleteAnswer = function(index){

			$uibModal.open({
	            templateUrl: 'deleteAnswerModal.html', // loads the template
	            backdrop: true, // setting backdrop allows us to close the modal window on clicking outside the modal window
	            windowClass: 'modal', // windowClass - additional CSS class(es) to be added to a modal window template
	            controller: function ($scope, $uibModalInstance,answers,question) {
					$scope.edit_answer_content = answers[index].content;
	                $scope.submit = function () {
	                   	$http.post('/questions/api/answer/delete',{id:answers[index].id})
				 			 .then(
				 			 	function(response){
					 			 	console.log('delete answer: ',response);
					 			 	answers.splice(index,1);
					 			 	if (index == question.bestAnswer.index) {
					 			 		question.bestAnswer = null;
					 			 	}
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
	                question:function(){
	                	return $scope.question;
	                },
	                answers:function(){
	                	return $scope.answers;
	                }
	            }
	        });//end of modal.open
		}

		$scope.showComments = function(answer_id){
			$scope.showComments[answer_id] = !$scope.showComments[answer_id];
		}

		//add new comment
		$scope.addComment = function(index) {
			ignoreLoadingBar: true;
			var comment_content = $scope.comment_content_field[index];
			$http.post('/questions/api/answer/comment-add',{answer_id:$scope.answers[index].id,content:comment_content})
	 			 .then(
	 			 	function(response){
		 			 	console.log('Add new comment: ',response.data);
		 			 	if (response.data != -1) {
		 			 		$scope.answers[index].comments_count++;
		 			 		response.data.date_created = "Vừa xong";
		 			 		$scope.answers[index].comments.push(response.data);
		 			 		if (index == $scope.question.bestAnswer.index) {
		 			 			$scope.question.bestAnswer.comments.push(response.data);
		 			 			$scope.question.bestAnswer.comments_count ++;
		 			 		}
		 			 		$scope.comment_content_field[index]="";
		 			 	}
	 			 	}
	 			 	,function(error){
	 			 		console.log(error);
	 		});
		}
		//vote comment
		$scope.voteComment = function(index,parentIndex) {
			ignoreLoadingBar: true;
			console.log(index,parentIndex);
			var comment_id = $scope.answers[parentIndex].comments[index].id;
			var isVoted = $scope.answers[parentIndex].comments[index].isVoted;
			$http.post('/questions/api/answer/comment/vote',{comment_id:comment_id,isVoted:isVoted})
	 			 .then(
	 			 	function(response){
	 			 		console.log('Vote comment:',response);
	 	
	 			 		if (response.data == -1) {window.location.href = '/login';}
	 			 		else if (response.data == 1) {
	 			 			$scope.answers[parentIndex].comments[index].votes_count++;
	 			 			$scope.answers[parentIndex].comments[index].isVoted  = 1;
	 			 			if (parentIndex == $scope.question.bestAnswer.index) {
	 			 				$scope.question.bestAnswer.comments[index].votes_count++;
	 			 				$scope.question.bestAnswer.comments[index].isVoted  = 1;
	 			 			}
	 			 		} else {
	 			 			$scope.answers[parentIndex].comments[index].votes_count--;
	 			 			$scope.answers[parentIndex].comments[index].isVoted = 0;
	 			 			if (parentIndex == $scope.question.bestAnswer.index) {
	 			 				$scope.question.bestAnswer.comments[index].votes_count--;
	 			 				$scope.question.bestAnswer.comments[index].isVoted  = 0;
	 			 			}
	 			 		}
	 			 		$scope.isCommentVoting[index] = 0;
	 			 	}
	 			 	,function(error){
	 			 	console.log(error);
	 		});
		}

		$scope.editCommentMode = function(index,parentIndex) {

			console.log('editing comment....');
			$scope.comment_editing[index] = 1;
			$scope.comment_editing_field[index] = $scope.answers[parentIndex].comments[index].content;
			if (parentIndex == $scope.question.bestAnswer.index) {
				$scope.comment_editing_field[index] = $scope.question.bestAnswer.comments[index].content;
			}
		}

		$scope.cancelEditComment = function(index) {
			console.log('cancel edit comment....');
			$scope.comment_editing[index] = 0;
		}
		//submit edited comment
		$scope.editComment = function(index, parentIndex){
			ignoreLoadingBar: true;
			var comment_id = $scope.answers[parentIndex].comments[index].id;
			var comment_content = $scope.comment_editing_field[index];
			$http.post('/questions/api/answer/comment/edit',{id:comment_id,content:comment_content})
	 			 .then(
	 			 	function(response){
		 			 	console.log('Edit comment: ',response);
		 			 	$scope.answers[parentIndex].comments[index].content = response.data.content;
		 			 	if (parentIndex == $scope.question.bestAnswer.index) {
							$scope.question.bestAnswer.comments[index].content = response.data.content;
						}
		 			 	$scope.comment_editing[index] = 0;
	 			 	}
	 			 	,function(error){
	 			 		console.log(error);
	 		});
		}
		//delete comment
		$scope.deleteComment = function(index,parentIndex){
			var comment_id = $scope.answers[parentIndex].comments[index].id;
			$http.post('/questions/api/answer/comment/delete',{id:comment_id})
	 			 .then(
	 			 	function(response){
	 			 		console.log('Delete comment:',response);
	 			 		$scope.answers[parentIndex].comments.splice(index,1);
	 			 		$scope.answers[parentIndex].comments_count--;
	 			 		if (parentIndex == $scope.question.bestAnswer.index) {
							$scope.question.bestAnswer.comments.splice(index,1);
							$scope.question.bestAnswer.comments_count--;
						}
	 			 	}
	 			 	,function(error){
	 			 	console.log(error);
	 		});
		}
	 });

})();