@extends('questions.layout')
@section('question_content')
	<div ng-init="setSelectedTab({{$tabSelected}})"></div>
	<div ng-init="getQuestionsTagged({{$questionTag->id}})"></div>
	<div class="row" id="top">
		<div class="col-md-12 filter-title" id="top">
			<p>Tagged: {{$questionTag->name}} <span class="pull-right">	@verbatim  {{questions.length}}@endverbatim </span></p>
		</div>
		@verbatim
			<div class="col-md-12 list-questions">
				<div ng-repeat="question in questions">
					<question-card></question-card>
				</div>
			</div>
			<div class="row" ng-show="totalPages!=1">
				<div class="col-md-12">
					<ul class="pagination">
						<li><a ng-class="{disabled:currentPage == 1}" ng-click="getQuestionsTagged(tag_id,1)">«</a></li>
						<li><a ng-class="{disabled:currentPage == 1}" ng-click="getQuestionsTagged(tag_id,currentPage-1)">‹</a></li>
						<li ng-repeat="i in range" ng-class="{active : currentPage == i}">
						<a ng-click="getQuestionsTagged(tag_id,i)">{{i}}</a>
						</li>
						<li><a ng-class="{disabled:currentPage == totalPages}" href="" ng-click="getQuestionsTagged(tag_id,currentPage+1)"> ›</a></li>
						<li><a ng-class="{disabled:currentPage == totalPages}" href="" ng-click="getQuestionsTagged(tag_id,totalPages)">»</a></li>
						</ul>
				</div>
			</div>
		@endverbatim	
	</div>	
@endsection
