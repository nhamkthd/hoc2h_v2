var app = angular.module('hoc2h-editTest', ['infinite-scroll']);
app.controller('editTest',function($scope,$http){
	$scope.tab=1;
	$scope.categories=[];
	$scope.test=[];
	$scope.mtests=[];
	$scope.mtestanswers=[];
	$scope.editTest=[];
	$http.get('/tests/api/getCategory').then(function(response) {
		$scope.categories = response.data;
	});
	$scope.editQa=function (index) {
		$('#myModal').modal('show');
	 	$scope.editTest=$scope.mtests[index];
	 	console.log($scope.mtests);
	}

	$scope.initEditTest=function (id) {
		$http.get('/tests/api/getEditTest/'+id).then(function(response) {
			$scope.test = response.data;
			$scope.category=$scope.test.category_id;
			$scope.level=$scope.test.level;
		});
	}
	$scope.getMtests=function (id) {
		$http.get('/tests/api/getMtests/'+id).then(function(response) {
			$scope.mtests = response.data.mtest;
		});
	}
	$scope.submit_test=function () {
		$scope.tab=2;
	}
	$scope.addQuesTion=function (content,explan) {	 		
	 		if($scope.mtestanswers.length>1)
	 		{
	 			var mt={};
		 		mt.content=content;
		 		mt.explan=explan;
		 		if(check_answer($scope.mtestanswers))
		 		{
		 			$scope.mtestanswers[0].is_correct=1;
		 			mt.m_test_answer=$scope.mtestanswers;
		 		}
		 		else
		 		{
		 			mt.m_test_answer=$scope.mtestanswers;
		 		}
		 		$scope.mtests.push(mt);
				$scope.mtestanswers=[];
				$scope.content='';
				$scope.explan='';
			}
			else
			{
				$scope.error='Phải lớn hơn 1 câu trả lời';
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
	 	$scope.addAnswer=function (answer,state) {
	 		switch(state) {
	 			case 'add':
	 			if(answer !== ''){
	 				var mta={};
	 				mta.title=answer;
	 				$scope.mtestanswers.push(mta);
	 				$scope.answer='';
	 				$scope.error='';
	 				$("html, body").animate({ scrollTop: $(document).height() }, "slow"); 
	 			}
	 				break;
	 			case 'edit':
	 			if(answer !== ''){
	 				var Emta={};
	 				Emta.title=answer;
	 				$scope.editTest.m_test_answer.push(Emta);
	 				$scope.answerEdit='';
	 				$scope.error='';
	 			}
	 				break;
	 		}
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
	 			console.log($scope.editTest.m_test_answer);
	 			console.log(index);
	 			for (var i = 0; i < $scope.editTest.m_test_answer.length; i++) {
	 				if(i===index)
	 				{
	 					$scope.editTest.m_test_answer[index].is_correct=1;
	 				}
	 				else
	 				{
	 					$scope.editTest.m_test_answer[i].is_correct=0;
	 				}

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
	 				if($scope.editTest.m_test_answer.length>1)
	 				{
	 					$http.post('/tests/api/deleteanswer', {id:$scope.editTest.m_test_answer[index].id}).then(function function_name(res) {
	 						$scope.editTest.m_test_answer.splice(index, 1);
	 					}, function (err) {
	 						console.log(err);
	 					})
	 				}
	 				break;
	 		}
	 		
	 	}	
	 	$scope.deleteShow=function(index) {
	 		$('#deleteQa').modal('show');
	 		$scope.index=index;
	 	}
	 	$scope.deleteQa=function (index) {
	 		$http.post('/tests/api/deleteqa', {id: $scope.mtests[index].id}).then(function (res) {
	 			$scope.mtests.splice(index,1);
	 		}, function (err) {
	 			console.log(err);
	 		});
	 		$('#deleteQa').modal('hide');
	 	}
	 	$scope.finish=function () {
	 		console.log($scope.mtests);
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
	 				$http.post('/tests/api/edit_mtest', {mtests:$scope.mtests,test:$scope.test}).then(function (req) {
	 					swal({
	 						title: "Sửa đề thi thành công",
	 						type: "success",
	 						confirmButtonColor: "#DD6B55",
	 						confirmButtonText: "Đến đề thi",
	 						closeOnConfirm: false
	 					},
	 					function(){
	 						window.location.href = '/tests';
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
})