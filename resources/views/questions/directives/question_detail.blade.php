@extends('questions.layout')
@section('question_content')
<div class="row">
	@verbatim
		{{question.setSelectedTab(0)}}
	@endverbatim
	<div ng-controller="QuestionDetailController">
		<div ng-init="initQuestion({{$question->id}},{{Auth::user()}})"></div>
		@verbatim
		<div class=" col-md-12 question-detail box">
			<div class="post-header">
				<h3 class="primary-color-dark">{{question.title}} </h3>
				<p>
					Đăng bởi <a href="#nothing" class="main-color">{{question.user.user_name}}</a> tại <a href class="warning-color-dark">Kiến Thức Lớp 12</a>
					<span class="pull-right">{{question.created_at}}</span>
				</p>
			</div>
			<p class="post-body" ng-bind-html="convertHtml(question.content)"></p>
			<div class="post-info">
				<ul class="nav nav-pills" role="tablist">
				  <li >Lượt xem <span class="badge ">{{question.view_count}}</span></li>
				</ul>
			</div> 
			<div class=" post-action">
				<ul class="nav nav-pills " role="tablist">
				  <li ng-show ="isVotedQuestion == 0"><a href ng-click="voteQuestion()"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Thích <span class="badge ">{{question_votes}}</span> </a></li>
				  <li ng-show ="isVotedQuestion == 1"><a href ng-click="voteQuestion()"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Bỏ thích <span class="badge ">{{question_votes}}</span> </a></li>
				  <li ><a href ng-click="answer()"><i class="fa fa-comment" aria-hidden="true"></i> Trả lời <span class="badge ">{{question_answers}}</span> </a> </li>
				  <li ><a href=""><i class="fa fa-share" aria-hidden="true"></i> Chia sẻ</a> </li>
				  <li ng-show="user.id == question.user_id" ><a href=""><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a> </li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-md-12 answer-list" ng-controller="AnswerController">
		<div class="row">
			<div class="col-md-12" ng-repeat="answer in answers">
			@endverbatim
				@include('questions.directives.answer_list_item')
			@verbatim
			</div>
			<div class="col-md-12 commet-box">
				<label>Câu trả lời của bạn</label>
				<textarea class="answer-edit-box" id="answer_field"  class="form-control" placeholder="abc"></textarea>
				<script>
					CKEDITOR.replace( 'answer_field',{
						filebrowserUploadUrl: "upload/upload.php" 
						});
				</script>
			</div>
			<button class="btn btn-main pull-right" style="margin-top:20px; margin-right: 10px;" type="button" ng-click="addAnswer()">Gửi trả lời</button>
		</div>
	</div>
	@endverbatim
</div>

@endsection