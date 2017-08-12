var app=angular.module('hoc2h-category', ['ng-nestable'])
app.run(function () {
	console.log('hello category');
})
app.controller('setting_itemCtrl',  function ($scope) {
	$scope.items=[
	{
		item: {id:2}, 
		children: [
			{
				item:{id:3},
				children:[]
			}
		]
	},
	{
		item: {},
		children: [
			{
				item: {},
				children: []
			}
		]
	},
	{
		item: {},
		children: []
	}
]
console.log($scope.items);
})