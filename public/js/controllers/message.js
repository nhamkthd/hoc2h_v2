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
	var app = angular.module('hoc2h-message', []);
	app.run(function(){
		console.log("hello message");
	});
	app.directive('finishRender', function ($timeout,listConversation) {
		return {
			restrict: 'A',
			link: function (scope, element, attr) {
				if (scope.$last === true) {
					$timeout(function () {
						for (var i = 0; i < listConversation.length; i++) {
							angular.element("#messages"+listConversation[i].id)[0].scrollTop=99999;
						}
					});
				}
			}
		}
	});
	app.factory('listUserOnline', function($http){
		listUserOnline=[];
		$http.get('/messages/api/listUserOnline/').then(function(res) {
			for (var i = 0; i < res.data.length; i++) {
				listUserOnline.push(res.data[i]);
			}
		}, function(err){
			console.log(err);
		})
		return listUserOnline;
	});
	app.factory('listConversation', function($http){
		listConversation=[];
		if(sessionStorage.conversation_id!=null)
		{
			var temp=sessionStorage.conversation_id.split(',');
			temp.pop();
			$http.post('/messages/api/getconversationopen',{conversation_id:temp}).then(function(res){
				for (var i =0; i<res.data.length; i++) {
					listConversation.push(res.data[i]);
				}
			}, function(err){
				console.log(err);
			})
		}
		return listConversation;
	});
	app.factory('listMessage', function(){
		listMessage=[]; 
		return listMessage;
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
	app.controller('MessageController',function($scope,$window, $http,listConversation,listMessage,$anchorScroll,$location,listUserOnline){
		$scope.listConversation=listConversation;
		$scope.show=true;
		$scope.listMessages=listMessage;
		$scope.listUserOnline=listUserOnline;
		$scope.close=function (index) {
			listConversation.splice(index, 1);
		}
		$scope.add_msg=function (id_user) {
			$http.get('/messages/api/getconversation/'+id_user).then(function (res) {
					if(findWithAttr(listConversation,'id',res.data.id)==-1)
					{
						listConversation.unshift(res.data);
						if(listConversation.length>3)
						{
							listConversation.pop();
						}
					}
			}, function (err) {
				console.log(err);
			})
		}
		$scope.send_msg=function (message,conversation,index) {
			var promise=$http.post('/messages/api/create', {message:message,conversation:conversation});
			promise.then(function (res) {
				listConversation[index].message.push(res.data);
			}, function (err) {
				
			})
		}
		$window.onbeforeunload  = function() {
			if(listConversation.length==0)
			{
				sessionStorage.conversation_id='';
			}
			sessionStorage.conversation_id='';
			for (var i = 0; i < listConversation.length; i++) {
				sessionStorage.conversation_id+=listConversation[i].id+',';
			}
		}
	});
	app.controller('ReceiveMessageController', function($scope,$window, $http,listConversation,listMessage,$anchorScroll,$location,listUserOnline){
		var channel = pusher.subscribe('private-App.User.' + user_id);
	 	channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data){
	 		if(data.conversation)
	 		{
				if(findWithAttr(listConversation,'id',data.conversation.id)!=-1)
				{
					$http.get('/').then(function(err){
						listConversation[findWithAttr(listConversation,'id',data.conversation.id)].message.push(data.message.original);
					})
				}
				else
				{
					$http.get('/messages/api/getconversation/'+data.message.original.user_id).then(function (res) {
							listConversation.unshift(res.data);
							if(listConversation.length>3)
							{
								listConversation.pop();
							}
					}, function (err) {
						console.log(err);
					})
				}
	 		}
	 	});
	 	
	})
})();
function findWithAttr(array, attr, value) {
	 		for(var i = 0; i < array.length; i += 1) {
	 			if(array[i][attr] === value) {
	 				return i;
	 			}
	 		}
	 		return -1;
	 	}