(function(){

	function getParameterByName(name, url) {
	    if (!url) url = window.location.href;
	    name = name.replace(/[\[\]]/g, "\\$&");
	    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
	        results = regex.exec(url);
	    if (!results) return null;
	    if (!results[2]) return '';
	    return decodeURIComponent(results[2].replace(/\+/g, " "));
	}
	

	var app = angular.module('hoc2h-test', ['infinite-scroll']);
	app.run(['$anchorScroll', function($anchorScroll) {
		$anchorScroll.yOffset = 50;   // always scroll by 50 extra pixels
	}]);
	     //test-list-card directive
	app.directive('testCard',function(){
		return {
			restrict:'E',
			templateUrl:'/tests/tests-card',
		}	
	});
		app.directive('postsPagination', function(){
		return {
			restrict: 'E',
			template: '<ul class="pagination">'+
			'<li><a ng-class="{disabled:currentPage == 1}" ng-click="getTest(1)">«</a></li>'+
			'<li><a class="page-link" ng-class="{disabled:currentPage == 1}" ng-click="getTest(currentPage-1)">‹ </a></li>'+
			'<li ng-repeat="i in range" ng-class="{active : currentPage == i}">'+
			'<a ng-click="getTest(i)">{{i}}</a>'+
			'</li>'+
			'<li><a ng-class="{disabled:currentPage == totalPages}" href="nothing" ng-click="getTest(currentPage+1)"> ›</a></li>'+
			'<li><a ng-class="{disabled:currentPage == totalPages}" href="nothing" ng-click="getTest(totalPages)">»</a></li>'+
			'</ul>'
		};
	});
	 app.directive('ngEnter', function() {
        return function(scope, element, attrs) {
            element.bind("keydown keypress", function(event) {
                if(event.which === 13) {
                    scope.$apply(function(){
                        scope.$eval(attrs.ngEnter, {'event': event});
                    });
                    event.preventDefault();
                }
            });
        };
    });
	 app.run(function(){
	 	console.log('hello Test');
	 });
	 app.controller('List_TestController', function ($scope,$http,$location,$anchorScroll) {
	 	$scope.tab=getParameterByName('filter');
	 	$scope.list_tests=[];
	 	$scope.totalPages = 0;
	 	$scope.currentPage = 1;
	 	$scope.range = [];
	 	switch($scope.tab) {
	 		case null:
	 			$scope.tab_name='Mới nhất';
	 			break;
	 		case 'usercreate':
	 			$scope.tab_name='Đề thi bạn đã tạo';
	 			break;
	 		case 'hot':
	 			$scope.tab_name='Đề thi nổi bật';
	 			break;
	 		case 'Mytesting':
	 			$scope.tab_name='Đề thi đã làm';
	 			break;
	 		case 'hotinweek':
	 			$scope.tab_name='Nổi bật trong tuần';
	 			break;
	 	}
	 	$scope.pageNumber=1;
	 	$scope.maxPageT;
	 	$scope.getTest=function (pageNumber) {
	 		if (pageNumber === undefined) {
	 			pageNumber = '1';
	 		}
	 		$http.get('/tests/gettest?filter='+$scope.tab+ '&page=' + pageNumber)
	 		.then(function(response){
	 			$location.hash('top');
      			$anchorScroll();
	 			console.log(response.data.data);
	 			$scope.total=response.data.total;
	 			$scope.list_tests = response.data.data;
	 			$scope.totalPages   = response.data.last_page;
	 			$scope.currentPage  = response.data.current_page;
	 			var pages = [];
	 			for (var i = 1; i <= response.data.last_page; i++) {
	 				pages.push(i);
	 			}
	 			$scope.range = pages;
	 		}, function(error){
	 			console.log(error);
	 		});
	 	}
	 	$scope.search=function () {
	 		if ($scope.keywords === '' || typeof $scope.keywords === 'undefined') {
	 			$http.get('/tests/gettest?filter='+$scope.tab)
	 			 .then(function(response){
	 			 	console.log(response.data);
	 			 	$scope.list_tests = response.data;
	 			 }, function(error){
	 			 	console.log(error);
	 			});
	 		} else {
	 			$http.get('/tests/api/search?keyword='+$scope.keywords)
	 			 .then(function(response){
	 			 		$scope.list_tests = response.data;
	 			 },function(error){
	 			 	console.log(error);
	 			 });
	 		}
	 	}
	 });	


	app.controller('ShowTestController', function ($scope,$http,$anchorScroll,$location) {
		$scope.gotoAnchor = function(x) {
			var newHash = 'anchor' + x;
			if ($location.hash() !== newHash) {
			  $location.hash('anchor' + x);
			} else {
			  $anchorScroll();
			}
			$scope.anchorAt = x;
	  };
		$scope.test=[];
		$scope.test_id;
		$scope.user;
		$scope.comment=[];
		$scope.pageComment=1;
		$scope.maxPage;
		$scope.avg_rate=0;
		$scope.editComment=new Array()
		$scope.initTest=function(test_id,user,id_comment) {
			$scope.test_id=test_id;
			console.log($scope.test_id);
			$scope.user=user;
			$http.post('/tests/api/getTest', {test_id:test_id}).then(function (res) {
				$scope.avg_rate=res.data.avg_rate;
				$scope.test=res.data;
				console.log($scope.test);
				console.log('go to answer:',id_comment);
				if (id_comment > 0) {
					console.log('go to answer:',id_comment);
					$scope.gotoAnchor(id_comment);
				}
			}, function(error) {
				console.log(error)
			})
		}
		$scope.initComment=function (test_id) {
			$http.get('/tests/api/getCommentTest/'+test_id).then(function (res) {
				$scope.comment=res.data.data;
				$scope.maxPage=res.data.last_page;
			}, function (err) {
				console.log(err)
			})
		}
		$scope.extendComment=function () {
			$scope.pageComment++;
			$http.get('/tests/api/getCommentTest/'+$scope.test_id+'?page='+$scope.pageComment).then(function (res) {	
				for (var i = 0; i < res.data.data.length; i++) {
	 				$scope.comment.push(res.data.data[i]);
	 			}
			}, function (err) {
				console.log(err)
			})
		}


		$scope.addComment=function(){
			if($scope.cmt.trim()!='')
			{
				$http.post('/tests/api/postCmt', {test_id:$scope.test_id,user_id:$scope.user.id,content:$scope.cmt}).then(function(res) {
					var cmt=[];
					cmt=res.data;
					cmt.user=$scope.user;
					cmt.user_like=new Array();
					$scope.comment.unshift(cmt);
					console.log($scope.test.cmts);
					$scope.cmt='';
				}, function (error) {
					console.log(error);
				})
			}
		}

		$scope.deleteCmt=function (index,cmt_id) {
			$http.post('/tests/api/postDeleteCmt',{cmt_id:cmt_id} ).then(function (res) {
				$scope.comment.splice(index, 1);
			}, function (error) {
				console.log(error);
			})
		}

		$scope.addRate=function(){
			$http.post('/tests/api/postAddRate', {user_id:$scope.user.id,rate:$scope.rate,test_id:$scope.test.id}).then(function(res){
				$scope.avg_rate=res.data;
				$('#rate-dialog').modal('hide');
			}, function (error) {
				console.log(error);
			})
		}

		$scope.likeComment=function(index,cmt_id)
		{

			$http.post('/tests/api/likeComment', {comment_id:cmt_id}).then(function(res) {
				$scope.comment[index].user_like.push(res.data.user_id);
			}, function (error) {
				console.log(error);
			})
		}

		$scope.dislikeComment=function(index,cmt_id)
		{
			$http.post('/tests/api/dislikeComment', {comment_id:cmt_id}).then(function(res) {
				$scope.comment[index].user_like.splice($scope.test.comment[index].user_like.indexOf($scope.user.id),1);
			}, function (error) {
				console.log(error);
			})
		}

		$scope.saveComment=function (index) {
			$http.post('/tests/api/editComment',{comment_id:$scope.test.comment[index].id,content:$scope.editComment[index]}).then(function (res) {
				$scope.comment[index].content=$scope.editComment[index];
			}, function (error) {
				console.log(error);
			})
			

		}

		
	});
	 
	 app.controller('TestController',function($http, $scope){

	 	$scope.tab=2;
	 	$scope.selectTab = function(setTab){
	 		console.log(setTab);
	 		
	 		if(setTab==1)
	 		{
	 			window.location.href = 'tests/create';
	 		}
	 		else
	 		{
	 			this.tab = setTab;
	 		}
	 	}

	 });	


	 app.controller('createTest', function ($scope,$http) {
	 	$scope.tab=1;
	 	$scope.hide=0;
	 	$scope.categories;

	 	//đối tượng test
	 	$scope.test={
	 		category_id:'',
	 		category_title:'',
	 		title:'',
	 		number_of_questions:0,
	 		time:0,
	 		type_test:0,
	 		level:0,
	 	};

	 	//đối tượng mtest
	 	function MTest(){	
	 		this.test_id=0;
	 		this.content='';
	 		this.explan='';
	 		this.incorrect_id='';
	 		this.answer=[];

	 		return this;
	 	}
	 	//đối tượng mtestanswer
	 	function MTestAnswer() {
	 		this.title='';
	 		this.is_correct=0;
	 		this.order_id=0;
	 		return this;
	 	}

	 	$scope.mtestanswers=[];
	 	$scope.mtests=[];
	 	$scope.is_correct=0;
	 	$scope.editTest=[];
	 	$scope.test_id;



	 	$http.get('api/getCategory').then(function(response) {
        	$scope.categories = response.data;
    	});

	 	$scope.submit_test=function() {
	 		$scope.test={
	 			category_id:$scope.category,
	 			category_title:$scope.category.title,
	 			title:$scope.title,
	 			number_of_questions:$scope.number_of_questions,
	 			time:$scope.time,
	 			level_title:$scope.level.title,
	 			level_id:$scope.level,
	 		};
	 		$scope.type_qa = 'Upload';
	 		$scope.tab = 2;
	 	}
	 	$scope.addAnswer=function (answer,state) {
	 		switch(state) {
	 			case 'add':
	 			if(answer !== ''){
	 				var mta=new MTestAnswer();
	 				mta.title=answer;
	 				$scope.mtestanswers.push(mta);
	 				$scope.answer='';
	 				$scope.error='';
	 				$("html, body").animate({ scrollTop: $(document).height() }, "slow"); 
	 			}
	 				break;
	 			case 'edit':
	 			if(answer !== ''){
	 				var Emta=new MTestAnswer();
	 				Emta.title=answer;
	 				$scope.editTest.answer.push(Emta);
	 				$scope.answerEdit='';
	 				$scope.error='';

	 			}
	 				break;
	 		}
	 		


	 	}

	 	$scope.removeAnswer=function (index,state) {
	 		switch(state) {
	 			case 'add':
	 				$scope.mtestanswers.splice(index, 1);
	 				break;
	 			case 'edit':
	 				if($scope.editTest.answer.length>1)
	 				{
	 					$scope.editTest.answer.splice(index, 1);
	 				}
	 				break;
	 		}
	 		
	 	}

	 	$scope.addQuesTion=function (content,explan) {
	 		
	 		if($scope.mtestanswers.length)
	 		{
		 		var mt=new MTest();
		 		mt.content=content;
		 		mt.explan=explan;
		 		
		 		if(check_answer($scope.mtestanswers))
		 		{
		 			$scope.mtestanswers[0].is_correct=1;
		 			mt.answer=$scope.mtestanswers;
		 		}
		 		else
		 		{
		 			mt.answer=$scope.mtestanswers;
		 		}

		 		$scope.mtests.push(mt);
				$scope.mtestanswers=[];
				$scope.content='';
				$scope.explan='';
			}
			else
			{
				$scope.error='Chưa có câu trả lời nào';
			}
	 	}

	 	function check_answer(arr) {
	 		for (var i = 0; i < arr.length; i++) {
		 			if(arr[i].is_correct==1)
		 			{
		 				return false;
		 			}
		 		}
		 	return true;
	 	}

	 	$scope.choice=function (index,state) {
	 		switch(state) {
	 			case 'add':
	 			for (var i = 0; i < $scope.mtestanswers.length; i++) {
	 				if(i===index)
	 				{
	 					$scope.mtestanswers[index].is_correct=1;
	 				}
	 				else
	 				{
	 					$scope.mtestanswers[i].is_correct=0;
	 				}

	 			}
	 				break;
	 			case 'edit':
	 			console.log($scope.editTest.answer);
	 			console.log(index);
	 			for (var i = 0; i < $scope.editTest.answer.length; i++) {
	 				if(i===index)
	 				{
	 					$scope.editTest.answer[index].is_correct=1;
	 				}
	 				else
	 				{
	 					$scope.editTest.answer[i].is_correct=0;
	 				}

	 			}
	 				
	 				break;
	 		}
	 		
	 		
	 	}

	 	$scope.editQa=function (index) {
	 		$('#myModal').modal('show');
	 		$scope.editTest=$scope.mtests[index];
	 	}
	 	$scope.deleteQa=function (index) {
	 		$scope.mtests.splice(index, 1);
	 	}

	 	$scope.finish=function () {
	 		if($scope.mtests.length)
	 		{
	 			$(window).unbind('beforeunload');
	 			swal({
	 				title: "Bạn có chắc chắn đã hoàn thành đề thi",
	 				type: "info",
	 				showCancelButton: true,
	 				closeOnConfirm: false,
	 				showLoaderOnConfirm: true,
	 			},
	 			function(){
	 				$http.post('api/create_mtest', {mtests:$scope.mtests,test:$scope.test}).then(function (req) {
	 					swal({
	 						title: "Tạo đề thi thành công",
	 						type: "success",
	 						confirmButtonColor: "#DD6B55",
	 						confirmButtonText: "Đến đề thi",
	 						closeOnConfirm: false
	 					},
	 					function(){
	 						window.location.href = '../tests';
	 					});
	 					
	 				}, function (error) {
	 			
	 				})
	 			});
	 			
	 		}
	 		else
	 		{
	 			swal("Chưa có câu hỏi nào!");
	 		}
	 	}
	 });
})();

