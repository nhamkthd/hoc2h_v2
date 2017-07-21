@extends('questions.layout')
@section('question_content')
	<div ng-init="setSelectedTab({{$tabSelected}})"></div>
	<div ng-init="getQuestionsTagged({{$questionTag->id}})"></div>
	<div class="row">
		<div class="col-md-12 filter-title">
			<p>Tagged: {{$questionTag->name}} <span class="pull-right">	@verbatim  {{questions.length}}@endverbatim </span></p>
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
