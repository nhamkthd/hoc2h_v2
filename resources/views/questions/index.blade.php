@extends('questions.layout')
@section('question_content')
	<div ng-init="setSelectedTab({{$tabSelected}})"></div>
	@verbatim
		<div ng-init="getQuestionsWithTab(tab)"></div>
	@endverbatim
	<div class="row">
		<div class="col-md-12 filter-action" style="background-color:#fafafa;">
			
		</div>
		@verbatim
			<div class="col-md-12 list-questions">
				<div ng-repeat="question in questions">
					<question-card></question-card>
				</div>
			</div>
		@endverbatim	
	</div>	
@endsection
