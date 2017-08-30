
@extends('questions.layout')
@section('question_content')
	@verbatim
		{{setSelectedTab(0)}}
	@endverbatim
	<div ng-init="getListTagsWithQuestionCategory({{$question->category_id}})"></div>
<div class="row" ng-controller="QuestionDetailController">
	@if($question)
		@if($answer_id)
			<div ng-init="initQuestion({{$question->id}},{{$answer_id}})"></div>
		@else
			<div ng-init="initQuestion({{$question->id}},0)"></div>
		@endif
	@else
		<div ng-init="questionNotFound()"></div>
	@endif
	@if(Auth::check())
		<div ng-init="getUser({{Auth::user()}})"></div>
	@endif
	<div ng-show ="isQuestionNotFound == 1" class="col-md-12">
		<p>Câu hỏi không tồn tại...!</p>
	</div>
	@if($question->user->isOnline())
	   	<div ng-init="authorIsOnline(1)"></div>
	@else 
		<div ng-init="authorIsOnline(0)"></div>
	@endif

	<div ng-show="isQuestionNotFound == 0">
		<div>
			@verbatim
			<div class=" col-md-12 question-detail box">
				<div class="post-header">
					<h3 class="unique-text">{{question.title}} </h3>
					<p>
						Đăng bởi <a class="author-name" href="/users/{{question.user.id}}/profile" class="primary-text" >
							<i class="fa fa-circle user-status" aria-hidden="true" ng-class="{online:question_author_isOnline === 1}"></i>{{question.user.name}}</a> 
						tại <a href class="warning-dark-text"> {{question.category.title}} </a>
							<a ng-click="editCategory()"> <i class="fa fa-edit" aria-hidden="true" ></i></a>
						<span class="pull-right"> <i class="fa fa-clock-o" aria-hidden="true"></i>  {{question.date_created}}</span>
					</p>
				</div>
				<p class="answer-body" ng-bind-html="question.content"></p>
				<div ng-show="!(question.tagsList.length == 0)" class="sidebar-tags" style="margin-bottom:20px; margin-left: -.5rem;">
					<ul>
						<li ng-repeat="tag in question.tagsList"><a href="/questions/tagged/?id={{tag.id}}">{{tag.name}}</a></li>
					</ul>
				</div>
				<div ng-show="(question.tagsList.length == 0) && (user.id == question.user_id)">
					<div class="form-group col-md-12" style="margin-left: -10px;">
						<div class="row">
							<div class="col-md-10 ">
								<select selector
										multi="true"
										model="newTagsList"
										options="tags"
										value-attr="id"
										label-attr="name"
										placeholder="Chèn tags"></select>
							</div>
							<div class="col-md-2" ng-show="!(newTagsList.length == 0)" style="margin-top: 8px;">
								<a ng-click="addNewTags()"><i class="fa fa-save" aria-hidden="true"></i> Lưu lại</a>
							</div>
						</div>
					</div>
				</div>
				<div class="post-info" ng-show="user.id == question.user_id">
					<ul class="nav nav-pills" role="tablist">
					  	<li class="action">
					  		<a ng-click="editQuestion()">
					  			<i class="fa fa-edit" aria-hidden="true"></i> Sửa
					  		</a>
					  	</li>
					  	<li class="action">
					  		<a ng-click="deleteQuestion(question.id)">
					  			<i class="fa fa-trash" aria-hidden="true"></i> Xoá
					  		</a>
					  	</li>
					  	<li class="action"><a ng-click="requestAnswer()"><i class="fa fa-magic" aria-hidden="true"></i> Yêu cầu</a></li>
					  	<li ng-show="question.is_resolved == 1"  ng-click="changeResolve(0)" class="action "><a><i class="fa fa-check-circle success-dark-text" aria-hidden="true"></i> Resolved</a></li>
					  	<li ng-show="question.is_resolved == 0" ng-click="changeResolve(1)" class="action "><a><i class="fa fa-check-circle danger-dark-text" aria-hidden="true"></i> Not resolve</a></li>
					</ul>
					@endverbatim
						@include('questions.directives.question_modal')
					@verbatim
				</div> 
				<div class=" post-action">
					<ul class="nav nav-pills " role="tablist">
					  	<li>
					  		<a ng-class="{voted:question.isVoted == 1}" href ng-click="voteQuestion()">
					  			<i ng-show="isVoting == 1" class="fa fa-spinner spinning" aria-hidden="true"></i>
					  			<i ng-show="isVoting == 0" class="fa fa-thumbs-up" aria-hidden="true"></i> 
					  			Thích <span>{{question.votes_count}}</span> 
					  		</a>
					  	</li>
					  	<li ><a href ng-click="gotoAnchor(0)">
					  		<i class="fa fa-comment" aria-hidden="true"></i> 
					  		Trả lời <span>{{question.answers_count}}</span> 
					  		</a> 
					  	</li>
					  <li >
					  <div class="fb-share-button" data-href="<?php echo "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];?>" data-layout="button_count" data-size="small" data-mobile-iframe="true">
					  		<a class="fb-xfbml-parse-ignore" target="_blank">Chia sẻ</a>
					  </div>
					  </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-12" ng-show="isLogged == false" style="margin-top: 20px;">
			<a href="/login">Đăng nhập để tham gia trả lời và bình luận →</a>
		</div>
		<div class="col-md-12">
			<div class="row answer-list">
				<p ng-hide="question.answers_count == 0" class="filter-title">{{question.answers_count}} Trả lời </p>
				<div  ng-hide="question.answers_count == 0" class="col-md-12" ng-repeat="answer in question.answers">
					@endverbatim
						@include('questions.directives.answer_list_item')
					@verbatim
				</div>
				<div ng-show="isLogged == true" style="margin-top: 20px;">
					<div class="col-md-12 commet-box" id="anchor{{0}}">
						<label>Câu trả lời của bạn</label>
						<div ckeditor="options" ng-model="answer_content_field" ready="onReady()"></div>
					</div>
					<div class="col-md-4" style="margin-top:20px; padding-left: 10px;">
						<button class="btn btn-primary " style="width: 100%" type="button" ng-click="addAnswer()">
					     <span ng-show="sendAnswerText === 'Sending'"><i class="fa fa-spinner spinning" aria-hidden="true"></i></span>
						{{sendAnswerText}}</button>
					</div>
				</div>
				<div class="col-md-12  related">
					<p class="filter-title">Câu hỏi liên quan</p>
					<div class="list-group related-list">
						<a href="#" class="list-group-item">Dapibus ac facilisis in</a>
						<a href="#" class="list-group-item">Morbi leo risus</a>
						<a href="#" class="list-group-item">Porta ac consectetur ac</a>
						<a href="#" class="list-group-item">Vestibulum at eros</a>
					</div>
				</div>
			</div>
		</div>
		@endverbatim
	</div>
</div>

@endsection