@extends('questions.layout')
@section('question_content')
	<div ng-init="setSelectedTab({{$tabSelected}})"></div>
	<div ng-init="getQuestionsTagged({{$questionTag->id}})"></div>
	<div class="row">
		<div class="col-md-12 filter-action" style="padding: 10px auto 10px; border-bottom:solid 2px #00695c;">
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
