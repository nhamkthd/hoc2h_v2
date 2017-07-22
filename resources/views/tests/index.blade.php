@extends('layouts.app')
@section('content')
@verbatim
<div class="container" ng-app ="hoc2h-test" ng-controller="List_TestController">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default widget" ng-init="getTest()">
				<div class="panel-heading">
					<i class="fa fa-list" aria-hidden="true"></i>
					<h3 class="panel-title"> Tất Cả Đề Thi</h3>
					<span class="label label-info">{{list_tests.length}}</span>
				</div>
				<div class="panel-body" ng-repeat="x in list_tests">
					<test-card></test-card>
				</div>
			</div>
		</div>
		@endverbatim
		@include('tests/sidebar')
	</div>
</div>

@endsection