@extends('layouts.app')
@section('content')
@verbatim
<style type="text/css">
	.img-responsive {width: 30px; height: 30px; margin-top: 10px;}
</style>
<div class="container app-content ng-scope" ng-app ="hoc2h-test" ng-controller="List_TestController" >
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default widget" ng-init="getTest()">
				<div class="panel-heading">
					<i class="fa fa-list" aria-hidden="true"></i>
					<h3 class="panel-title"> {{tab_name}} </h3>
					<span class="label label-info">{{list_tests.length}}</span>
				</div>
				<div class="panel-body" ng-repeat="test in list_tests|orderBy : '-id'">
					<test-card></test-card>
				</div>
				<div class="col-md-12" ng-show="pageNumber!=maxPageT">
					<div class="col-md-3 col-md-offset-5 col-xs-3 col-xs-offset-5">
						<button class="btn btn-primary" ng-click="loadingTest()"><i class="fa fa-spinner" aria-hidden="true"></i> Tải thêm câu hỏi</button>
					</div>
				</div>
				@endverbatim
			</div>
		</div>
		@include('tests/sidebar')
	</div>
	
</div>

@endsection