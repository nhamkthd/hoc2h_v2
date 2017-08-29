@extends('layouts.app')
@section('content')
@verbatim
<div class="container app-content ng-scope" ng-app ="hoc2h-test" ng-controller="List_TestController" >
	<div class="row" id="top">
		<div class="col-md-8">
			<div class="panel panel-default widget" ng-init="getTest()">
				<div class="panel-heading">
					<i class="fa fa-list" aria-hidden="true"></i>
					<h3 class="panel-title"> {{tab_name}} </h3>
					<span class="label label-info">{{total}}</span>
				</div>
				<div class="panel-body" ng-repeat="test in list_tests|orderBy : '-id'">
					<test-card></test-card>
				</div>
				<div class="row"  ng-show="totalPages!=1">
					<div class="col-md-6">
						<posts-pagination class="text-center"></posts-pagination>
					</div>
				</div>
				@endverbatim
			</div>
		</div>
		@include('tests/sidebar')
	</div>
</div>

@endsection