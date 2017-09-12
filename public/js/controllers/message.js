(function(){
	var app = angular.module('hoc2h-message', []);
	app.run(function(){
		console.log("hello message");
	});

	app.factory('listConversation', function($http){
		listConversation=[];
		//lấy tất cả các tin nhắn đang mở
		// $http.get('/messages/api/getConversationOpen').then(function (res) {
		// 	for (var i = 0; i < res.data.length; i++) {
		// 		listConversation.push(res.data[i]);
		// 	}	
		// }, function (err) {
		// 	// body...
		// })
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
	app.controller('MessageController',function($scope, $http,listConversation,listMessage,$anchorScroll,$location){
		$scope.listConversation=listConversation;
		$scope.show=true;
		$scope.listMessages=listMessage;
		$scope.close=function (index) {
			$scope.listConversation.splice(index, 1);
		}
		$scope.add_msg=function (id_user) {
			var mang=[];
			for (var i = 0; i < listConversation.length; i++) {
				mang.push(listConversation[i].id);
			}
			$http.get('/messages/api/getconversation/'+id_user).then(function (res) {
					if(mang.indexOf(res.data.id)==-1)
					{
						listConversation.push(res.data);
					}
			}, function (err) {
				console.log(err);
			})
		}
		$scope.send_msg=function (message,conversation,index) {
			$http.post('/messages/api/create', {message:message,conversation:conversation}).then(function (res) {
				listConversation[index].message.push(res.data);
				$location.hash('bottom');
      			$anchorScroll();
			}, function (err) {
				
			})
		}
	});

})();