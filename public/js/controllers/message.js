(function(){
	var app = angular.module('hoc2h-message', []);
	app.run(function(){
		console.log("hello message");
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
	 app.directive('scroll', function($timeout) {
	 	return {
	 		restrict: 'A',
	 		link: function(scope, element, attr) {
	 			scope.$watchCollection(attr.scroll, function(newVal) {
	 				$timeout(function() {
	 					element[0].scrollTop = element[0].scrollHeight;
	 				});
	 			});
	 		}
	 	}
	 });
	app.controller('MessageController',function($scope, $http,listConversation,listMessage,$anchorScroll,$location,listUserOnline){
		$scope.listConversation=listConversation;
		$scope.show=true;
		$scope.listMessages=listMessage;
		$scope.listUserOnline=listUserOnline;
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