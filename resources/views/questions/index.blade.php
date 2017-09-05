@extends('questions.layout')
@section('question_content')
	<div ng-init="setSelectedTab({{$tabSelected}})"></div>
	@verbatim
		<div ng-init="getQuestionsWithTab(1)"></div>
		<div class="row" id="top">
			<div class="col-md-12">
				<p class="filter-title">{{tab_name}} <span class="pull-right info-dark-text">{{total}} </span></p>
			</div>
			<div class="col-md-12 list-questions">
				<div ng-repeat="question in questions">
					<question-card></question-card>
				</div>
			</div>	
		</div>	
		<div class="row" ng-show="totalPages!=1 && isLoaded == 1">
			<div class="col-md-12">
				<posts-paginations class="text-center"></posts-paginations>
			</div>
		</div>
	@endverbatim
@endsection
