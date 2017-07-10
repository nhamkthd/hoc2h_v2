@extends('questions.layout')
@section('question_content')
	@verbatim
		<div ng-init="setSelectedTab(1)"></div>
		<div ng-init="getQuestionsWithTab(tab)"></div>
		<div class="row">
			<div class="col-md-12 filter-action" style="background-color:#fafafa;">
			
			</div>
			<div class="col-md-12 list-questions">
				<div ng-repeat="question in questions">
					<question-card></question-card>
				</div>
			</div>
		</div>	
	@endverbatim	
@endsection
