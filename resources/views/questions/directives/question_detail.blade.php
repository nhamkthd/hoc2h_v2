@extends('questions.layout')
@section('question_content')
	@verbatim
		{{setSelectedTab(0)}}
	@endverbatim
<div class="row" ng-controller="QuestionDetailController">
	<div >
		<div ng-init="initQuestion({{$question->id}},{{Auth::user()}})"></div>
		@verbatim
		<div class=" col-md-12 question-detail box">
			<div class="post-header">
				<h3 class="unique-text">{{question.title}} </h3>
				<p>
					Đăng bởi <a href="#nothing" class="primary-text">{{question.user.user_name}}</a> tại <a href class="warning-dark-text">Kiến Thức Lớp 12 </a> <a> <i class="fa fa-edit" aria-hidden="true"></i></a>
					<span class="pull-right">{{question.created_at}}</span>
				</p>
			</div>
			<p class="post-body" ng-bind-html="convertHtml(question.content)"></p>
			<div class="post-info" ng-show="user.id == question.user_id">
				<ul class="nav nav-pills" role="tablist">
				  	<li class="action">
				  		<a data-toggle="modal" data-target="#edit_question_m" ng-click="showEditQuestion()">
				  			<i class="fa fa-edit" aria-hidden="true"></i> Sửa
				  		</a>
				  	</li>
				  	<li class="action">
				  		<a data-toggle="modal" data-target="#delete_question_m">
				  			<i class="fa fa-trash" aria-hidden="true"></i> Xoá
				  		</a>
				  	</li>
				  	<li class="action"><a><i class="fa fa-magic" aria-hidden="true"></i> Yêu cầu</a></li>
				</ul>
				@endverbatim
					@include('questions.directives.question_modal')
				@verbatim
			</div> 
			<div class=" post-action">
				<ul class="nav nav-pills " role="tablist">
				  	<li ng-show ="isVotedQuestion == 0">
				  		<a href ng-click="voteQuestion()">
				  			<i class="fa fa-thumbs-up" aria-hidden="true"></i> 
				  			Thích <span class="badge ">{{question_votes}}</span> 
				  		</a>
				  	</li>
				  	<li ng-show ="isVotedQuestion == 1">
				  		<a href ng-click="voteQuestion()">
				  			<i class="fa fa-thumbs-down" aria-hidden="true"></i> 
				  			Bỏ thích <span class="badge ">{{question_votes}}</span> 
				  		</a>
				  	</li>
				  	<li ><a href ng-click="gotoAnchor(1)">
				  		<i class="fa fa-comment" aria-hidden="true"></i> 
				  		Trả lời <span class="badge ">{{answer_count}}</span> 
				  		</a> 
				  	</li>
				  <li ><a href=""><i class="fa fa-share" aria-hidden="true"></i> Chia sẻ</a> </li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-md-12 answer-list">
		<div class="row">
			<div class="col-md-12" ng-repeat="answer in question.answers">
				@endverbatim
					@include('questions.directives.answer_list_item')
				@verbatim
			</div>
			<div class="col-md-12 commet-box" id="anchor{{1}}">
				<label>Câu trả lời của bạn</label>
				<div ckeditor="options" ng-model="answer_content_field" ready="onReady()"></div>
			</div>
			<button class="btn btn-outline-default waves-effect pull-right" style="margin-top:20px; margin-right: 10px;" type="button" ng-click="addAnswer()">Gửi trả lời</button>
		</div>
		
	</div>
	@endverbatim
</div>

@endsection