@extends('questions.layout')
@section('question_content')
	<div ng-init="setSelectedTab({{$tabSelected}})"></div>
	@verbatim
		<div ng-init="getQuestionsWithTab(tab)"></div>
		<div class="row">
			<div class="col-md-12">
				<p class="filter-title">{{tab_name}} <span class="pull-right info-dark-text">{{questions.length}} </span></p>
			</div>
			<div class="col-md-12 list-questions">
				<div ng-repeat="question in questions">
					<question-card></question-card>
				</div>
			</div>	
		</div>	
		<div class="row" ng-show="isPaginate == true">
			<div class="col-md-6" ng-show="questions.length > 15">
				<posts-paginations class="text-center"></posts-paginations>
			</div>
		</div>
	@endverbatim
@endsection
