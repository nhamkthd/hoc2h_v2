(function(){
	var pusher = new Pusher('5ac087c889597b081cac', {
          cluster: 'ap1',
          encrypted: true,
           authEndpoint: '/pusher/auth',
            auth: {
                headers: {
                    'X-CSRF-Token':  $('meta[name="csrf-token"]').attr('content')
                }
            }
      });	
	
	
	var app = angular.module('hoc2h-heading', []);
	 app.run(function(){
	 	
	 });

	 app.controller('HeadingController',function($scope, $http){
	 	$scope.notification=[];
	 	$scope.unReadNotification=[];
	 	$scope.initNotification=function()
	 	{
	 		$http.post('/notification/getNotification').then(function (res) {
	 			$scope.notification=res.data.notifications;
	 			$scope.unReadNotification=res.data.unreadNotifications;
	 		}, function (err) {
	 			console.log(err);
	 		})
	 	}

	 	$scope.readNotify=function (count) {
	 		if(count==0)
	 		{
	 			
	 		}
	 		else
	 		{
	 			$http.post('/notification/readNotification').then(function (res) {
	 				$scope.unReadNotification=res.data;
	 				
	 			}, function (err) {
	 				console.log(err);
	 			})
	 		}
	 	}

	 	var channel = pusher.subscribe('private-App.User.' + user_id);
	 	channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data){
	 		$http.post('/notification/getNotification').then(function (res) {
	 			$scope.notification=res.data.notifications;
	 			$scope.unReadNotification=res.data.unreadNotifications;
	 		}, function (err) {
	 			console.log(err);
	 		})
	 	});




	 });
})();