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
	 	console.log("hello heading");
	 });

	 app.controller('HeadingController',function($scope, $http){
	 	$scope.notification=[];
	 	$scope.unReadNotification=[];
	 	var user = {};
	 	$scope.getUser = function(user) {
	 		this.user = user;
	 	}

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
	 				$scope.unReadNotification=[];
	 				
	 			}, function (err) {
	 				console.log(err);
	 			})
	 		}
	 	}


	 	var channel = pusher.subscribe('private-App.User.' + user_id);
	 	channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data){
	 		$.notify({
    				message:data.user.name +' đã '+ data.kind +' '+ data.model +' của bạn' ,
    				url: data.link,
				},{
    				mouse_over: 'pause',
    				placement: {
    					from: "bottom",
    					align: "left"
    				},
				});
	 		$http.post('/notification/getNotification').then(function (res) {
	 			$scope.notification=res.data.notifications;
	 			$scope.unReadNotification=res.data.unreadNotifications;
	 		}, function (err) {
	 			console.log(err);
	 		})
	 	});

	 });
})();