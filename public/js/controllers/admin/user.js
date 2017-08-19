var app=angular.module('hoc2h-user', []);
app.run(function () {
	console.log('hello user');	
})
app.controller('userController', function ($scope,$http) {
	$scope.list_users=[];
	$scope.list_user=function () {
		$http.get('/admin/api/user/list').then(function function_name(res) {
			$scope.list_users=res.data;
			console.log(res.data);
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
})
