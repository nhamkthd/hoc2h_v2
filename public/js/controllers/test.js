(function(){
	 var app = angular.module('hoc2h-test', []);

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


	app.controller('ShowTestController', function ($scope,$http) {
		$scope.test=[];
		$scope.test_id;
		$scope.user;
		$scope.avg_rate=0;
		$scope.editComment=new Array()
		$scope.initTest=function(test_id,user) {
			$scope.test_id=test_id;
			console.log($scope.test_id);
			$scope.user=user;
			$http.post('/tests/api/getTest', {test_id:test_id}).then(function (res) {
				$scope.test=res.data.test;
				$scope.test.cmts=res.data.test_comment;
				$scope.test.category=res.data.test_category;
				$scope.avg_rate=res.data.rate_avg;
				$scope.user_rate=res.data.user_rate;
			}, function(error) {
				console.log(error)
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
					$scope.test.cmts.push(cmt);
					console.log($scope.test.cmts);
					$scope.cmt='';
				}, function (error) {
					console.log(error);
				})
			}
		}

		$scope.deleteCmt=function (index,cmt_id) {
			$http.post('/tests/api/postDeleteCmt',{cmt_id:cmt_id} ).then(function (res) {
				$scope.test.cmts.splice(index, 1);
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
				$scope.test.cmts[index].user_like.push($scope.user.id);
			}, function (error) {
				console.log(error);
			})
		}

		$scope.dislikeComment=function(index,cmt_id)
		{
			$http.post('/tests/api/dislikeComment', {comment_id:cmt_id}).then(function(res) {
				$scope.test.cmts[index].user_like.splice($scope.test.cmts[index].user_like.indexOf($scope.user.id),1);
			}, function (error) {
				console.log(error);
			})
		}

		$scope.saveComment=function (index) {
			$http.post('/tests/api/editComment',{comment_id:$scope.test.cmts[index].id,content:$scope.editComment[index]}).then(function (res) {
				$scope.test.cmts[index].content=$scope.editComment[index];
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
	 	$scope.categorys;

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
	 	//đối tượng wtest
	 	$scope.wtest={
	 		test_id:0,
	 		content:'',
	 		explan:'',
	 		is_document:0,
	 		is_document_explan:0,
	 	}
	 	

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
        	$scope.categorys = response.data;
    	});

	 	$scope.submit_test=function(type_test) {
	 		$scope.test={
	 			category_id:$scope.category.id,
	 			category_title:$scope.category.title,
	 			title:$scope.title,
	 			number_of_questions:$scope.number_of_questions,
	 			time:$scope.time,
	 			type_test:type_test,
	 			level_title:$scope.level.title,
	 			level_id:$scope.level.id,
	 		};
	 		$scope.type_qa='Upload';
	 		if(type_test==1)
	 		{
	 			//tự luận
					$scope.tab=2;
	 		}
	 		else
	 		{
	 			//trắc nhiệm
	 			$scope.tab=3;
	 			
	 			
	 		}
	 	}

	 	$scope.click_upload_qa=function(state) {
	 		if (state=='Upload') {
	 			$scope.type_qa='Soạn đề';
	 			$scope.upload_qa=1;
	 			$scope.write_qa=0;
	 			$scope.wtest.is_document=1;
	 			$scope.wtest.content=$scope.document;
	 			console.log($scope.document);
	 		}
	 		else
	 		{
	 			$scope.type_qa='Upload';
	 			$scope.upload_qa=0;
	 			$scope.write_qa=1;
	 			$scope.wtest.is_document=0;
	 			$scope.wtest.content=CKEDITOR.instances.content.getData();
	 		} 
	 	}

	 	$scope.submit_wTest=function() {
	 		alert('ok')
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

