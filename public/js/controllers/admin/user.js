var app=angular.module('hoc2h-user', []);
app.run(function () {
	console.log('hello user');	
})
app.directive('postsPagination', function(){
    return {
      restrict: 'E',
      template: '<ul class="pagination">'+
      '<li><a ng-class="{disabled:currentPage == 1}" ng-click="list_user(1)">«</a></li>'+
      '<li><a class="page-link" ng-class="{disabled:currentPage == 1}" ng-click="list_user(currentPage-1)">‹ </a></li>'+
      '<li ng-repeat="i in range" ng-class="{active : currentPage == i}">'+
      '<a ng-click="list_user(i)">{{i}}</a>'+
      '</li>'+
      '<li><a ng-class="{disabled:currentPage == totalPages}" ng-click="list_user(currentPage+1)"> ›</a></li>'+
      '<li><a ng-class="{disabled:currentPage == totalPages}" ng-click="list_user(totalPages)">»</a></li>'+
      '</ul>'
    };
  });
app.controller('userController', function ($scope,$http) {
	$scope.list_users=[];
  $scope.list_tests=[];
  $scope.totalPages = 0;
  $scope.currentPage = 1;
  $scope.range = [];
	$scope.list_user=function (pageNumber) {
    if (pageNumber === undefined) {
        pageNumber = '1';
      }
		$http.get('/admin/api/user/list?page=' + pageNumber).then(function function_name(res) {
			   $scope.list_users=res.data.data;
        $scope.totalPages   = res.data.last_page;
        $scope.currentPage  = res.data.current_page;
        var pages = [];
        for (var i = 1; i <= res.data.last_page; i++) {
          pages.push(i);
        }
        $scope.range = pages;
		}, function function_name(err) {
			console.log(err);
		})
	}
	$scope.deleteMulti=function(list){
		 var itemList = []; 
		 var listIndex=[];
        angular.forEach(list, function(value, key) {  
            if (list[key].selected) {  
            	//console.log(key);
                itemList.push(list[key].selected);
                listIndex.push(key);  
            }  
            });  
            //console.log(itemList)
           $http.post('/admin/api/user/Multidelete', {'id':itemList}).then(function(res){ 		  
           	if (res) {
           		angular.forEach(listIndex, function(value, key) {  
           			$scope.list_users.splice(value, 1);
           		});
           	}
           }, function(err){
           });
           
		}
    $scope.onsearch=function (key) {
      $http.get('/admin/api/user/search?key='+key).then(function(res){
          $scope.list_users=res.data;
      }, function(err){
        console.log(err);
      })
    }
})
