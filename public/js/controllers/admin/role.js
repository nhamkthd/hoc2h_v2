	var app = angular.module('hoc2h-role', ['ui.bootstrap']);
	 app.run(function(){
	 	console.log("hello role");
	 });
	 app.factory('role', [function () {
	 	return {
	 		list_roles:[]
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
				title_edit:$scope.list_roles[index].title,
				description_edit:$scope.list_roles[index].discription,
				id:id,
				index:index,
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
			if(id==1||id==2||id==3||id==4){
					var modalInstance = $uibModal.open({
					templateUrl: 'modal_warning.html',
					controller: 'warningModal',
					size:'md',
				});
			}
			else
			{
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
		}
	 });

	 app.controller('ModalInstanceCtrl',function ($scope,$http,$uibModalInstance,role) {
	 	$scope.cancel=function () {
	 		$uibModalInstance.dismiss('cancel');
	 	}
	 	$scope.ok=function () {
	 		var data={
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
	  app.controller('editModal',function ($scope,$http,$uibModalInstance,role,data) {
	  	$scope.title_edit=data.title_edit;
	  	$scope.id_edit=data.id;
	  	$scope.description_edit=data.description_edit;
	 	$scope.cancel=function () {
	 		$uibModalInstance.dismiss('cancel');
	 	}
	 	$scope.ok=function () {
	 		var datas={
	 			index:data.index,
	 			id:$scope.id_edit,
	 			title:$scope.title_edit,
	 			description:$scope.description_edit,
	 		};
	 		$http.put('/admin/api/role/update', datas).then(function (res) {
	 			role.list_roles[data.index]=res.data;
	 			$uibModalInstance.dismiss('cancel');
	 		}, function (err) {
	 			console.log(err);
	 		})
	 	}
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
	  app.controller('warningModal',function ($scope,$http,$uibModalInstance) {
	 	$scope.cancel=function () {
	 		$uibModalInstance.dismiss('cancel');
	 	}
	 })