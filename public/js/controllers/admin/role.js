	var app = angular.module('hoc2h-role', ['ui.bootstrap']);
	 app.run(function(){
	 	console.log("hello role");
	 });
	 app.factory('role', [function () {
	 	return {
	 		list_roles:[]
	 	};
	 }])
	 app.factory('levels', [function () {
	 	return {
	 		levels:[
	  		{id:1,title:'Super'},
	  		{id:2,title:'Admin'},
	  		{id:3,title:'Mode'},
	  		{id:4,title:'Member'},
	  		]
	 	};
	 }])
	 app.controller('role',function ($scope,$http,$uibModal,role) {
	 	$scope.list_roles=[];
	 	$scope.listrole=function() {
	 		$http.get('/admin/api/role/list').then(function(res) {
	 			role.list_roles=res.data;
	 			$scope.list_roles=role.list_roles;
	 		}, function (err) {
	 			console.log(err);
	 		})
	 	}
	 	$scope.add=function () {
	 		var modalInstance = $uibModal.open({
	 			templateUrl: 'myModalContent.html',
	 			controller: 'ModalInstanceCtrl',
	 			size:'md',	
	 		});
		 	}
		$scope.edit=function (id,index) {
			var data={
				level_edit:$scope.list_roles[index].level,
				title_edit:$scope.list_roles[index].title,
				description_edit:$scope.list_roles[index].discription
			}
			var modalInstance = $uibModal.open({
	 			templateUrl: 'editModal.html',
	 			controller: 'editModal',
	 			size:'md',
	 			resolve: {
	 				data: function () {
	 					return data;
	 				}
	 			}
	 		});
		}
		$scope.delete=function (id,index) {
			var modalInstance = $uibModal.open({
				templateUrl: 'modal_delete.html',
				controller: 'deleteModal',
				size:'md',
				resolve: {
					data:{
						id:id,
						index:index,
					}
				}
			});
		}
	 });

	 app.controller('ModalInstanceCtrl',function ($scope,$http,$uibModalInstance,role) {
	 	$scope.cancel=function () {
	 		$uibModalInstance.dismiss('cancel');
	 	}
	 	$scope.ok=function () {
	 		var data={
	 			level:$scope.level,
	 			title:$scope.title,
	 			description:$scope.description,
	 		};
	 		$http.post('/admin/api/role/create', data).then(function (res) {
	 			role.list_roles.push(res.data);
	 			console.log(role.list_roles);
	 			$uibModalInstance.dismiss('cancel');
	 		}, function (err) {
	 			console.log(err);
	 		})
	 	}
	 })
	  app.controller('editModal',function ($scope,$http,$uibModalInstance,role,data,levels) {
	  	$scope.level_edit=data.level_edit;
	  	$scope.title_edit=data.title_edit;
	  	$scope.description_edit=data.description_edit;
	  	$scope.levels=levels.levels;
	 	$scope.cancel=function () {
	 		$uibModalInstance.dismiss('cancel');
	 	}
	 	// $scope.ok=function () {
	 	// 	var data={
	 	// 		level:$scope.level,
	 	// 		title:$scope.title,
	 	// 		description:$scope.description,
	 	// 	};
	 	// 	$http.post('/admin/api/role/create', data).then(function (res) {
	 	// 		role.list_roles.push(res.data);
	 	// 		console.log(role.list_roles);
	 	// 		$uibModalInstance.dismiss('cancel');
	 	// 	}, function (err) {
	 	// 		console.log(err);
	 	// 	})
	 	// }
	 })

	 app.controller('deleteModal',function ($scope,$http,$uibModalInstance,role,data) {
	 	console.log(data);
	 	$scope.cancel=function () {
	 		$uibModalInstance.dismiss('cancel');
	 	}
	 	$scope.ok=function () {
	 		$http.delete('/admin/api/role/delete/'+data.id).then(function (res) {
	 			role.list_roles.splice(data.index,1);
	 			$uibModalInstance.dismiss('cancel');
	 		}, function (err) {
	 			console.log(err);
	 		})
	 	}
	 })