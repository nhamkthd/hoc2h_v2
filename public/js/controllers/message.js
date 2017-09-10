(function(){
	var app = angular.module('hoc2h-message', []);
	app.run(function(){
		console.log("hello message");
	});
	app.factory('list_msg', function(){
		list_msg = []; 
		return list_msg;

	});
	app.controller('MessageController',function($scope, $http,list_msg){
		$scope.list_msg=list_msg;
		$scope.show=true;
		$scope.close=function (index) {
			$scope.list_msg.splice(index, 1);
		}
		$scope.add_msg=function (id_user) {
			if(list_msg.indexOf(id_user))
			{
				list_msg.push(id_user);
				$http.get('/messages/api/getMessage/'+id_user).then(function (res) {
					
				}, function (err) {
					console.log(err);
				});
			}
			else
			{

			}
		}
	});

})();