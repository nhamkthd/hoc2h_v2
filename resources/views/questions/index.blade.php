@extends('questions.layout')
@section('question_content')
	<div ng-init="setSelectedTab({{$tabSelected}})"></div>
	@verbatim
		<div ng-init="getQuestionsWithTab(tab)"></div>
		<div class="row">
			<div class="col-md-12">
				<p class="filter-title">{{tab_name}} <span class="pull-right info-dark-text">{{questions_count}} </span></p>
			</div>
			<div class="col-md-12 list-questions">
				<div ng-repeat="question in questions">
					<question-card></question-card>
				</div>
			</div>	
		</div>	
		<div class="col-md-12" ng-show="pageNumber!=maxPage">
			<div class="col-md-3 col-md-offset-5 col-xs-3 col-xs-offset-5">
				<button class="btn btn-primary" ng-click="loadingQa()"><i class="fa fa-spinner" aria-hidden="true"></i> Tải thêm câu hỏi</button>
			</div>
		</div>
	@endverbatim
@endsection
