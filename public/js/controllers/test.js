(function(){
	 var app = angular.module('hoc2h-test', []);
	 app.run(function(){
	 	console.log('hello Test');
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
	 		title:'',
	 		number_of_questions:0,
	 		time:0,
	 		type_test:0,
	 		level:0,
	 	};

	 	$http.get('api/getCategory').then(function(response) {
        	$scope.categorys = response.data;
    	});

	 	$scope.submit_test=function(type_test) {
	 		
	 		if(type_test==1)
	 		{
	 			//tự luận
	 			this.tab=2;
				
	 		}
	 		else
	 		{
	 			//trắc nhiệm
	 			console.log($scope.category_id)
	 		}
	 	}


	 });

})();

