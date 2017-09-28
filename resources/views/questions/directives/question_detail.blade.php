<style type="text/css">
	.best-answer-panel {padding:10px 15px; border-bottom: 1px dashed #d7d7d7;}
	h5.panel-title {padding: 1em 2em;border-bottom: 1px solid #66bb6a; background:#66bb6a; color: #fff; border-top-left-radius: 2px; border-top-right-radius: 2px;}
	.panel-body {border:1px solid #e6e6e6 ; border-top: none; border-top-left-radius: 0; border-top-right-radius: 0; border-bottom-left-radius: 2px; border-bottom-right-radius: 2px;}
	.media {text-align: left; align-items: flex-start;display: flex;}
	.media-avatar {margin-right: 10px;}
	.media-body {padding-left: 10px;}
	
	li.dropdown:hover {cursor: pointer;}
	.actions-nav ul.dropdown-menu {display: none;}
	li.dropdown:hover ul.dropdown-menu {display: block;}

</style>
@extends('questions.layout')
@section('question_content')
	@verbatim
		{{setSelectedTab(0)}}
	@endverbatim
	<div ng-init="getQuestionRelated({{$question->id}})"></div>
	<div ng-init="getListTagsWithQuestionCategory({{$question->category_id}})"></div>
	<div class="row" ng-controller="QuestionDetailController">
	@if($question)
		@if($answer_id)
			@if($comment_id)
				<div ng-init="getQuestionInfo({{$question->id}},{{$answer_id}},{{$comment_id}})"></div>
			@else
				<div ng-init="getQuestionInfo({{$question->id}},{{$answer_id}},0)"></div>
			@endif
		@else
			<div ng-init="getQuestionInfo({{$question->id}},0,0)"></div>
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
					<h4 class="unique-text" style="font-weight: 600;">{{question.title}} </h4>
					<p>
						Đăng bởi <a class="author-name" href="/users/{{question.user.id}}/profile" class="primary-text" >
							<i class="fa fa-circle user-status" aria-hidden="true" ng-class="{online:question_author_isOnline === 1}"></i>{{question.user.name}}</a> 
						tại <a href class="category-title"> {{question.category.title}} </a>
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
				<div class="post-info">
					<ul class="nav nav-pills" role="tablist">
						<li ng-class="{voted:question.isVoted == 1}"  ng-click="voteQuestion()">
								<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
								Thích <span>{{question.votes_count}}</span></li>

						<li ng-click="gotoAnchor(0)">
								<i class="fa fa-comment-o" aria-hidden="true"></i> Trả lời <span>{{answers_count}}</span></li>

						<li><i class="fa fa-eye" aria-hidden="true"></i> Xem <span>{{question.views_count}}</span></li>

						<li><div class="fb-share-button" data-href="<?php echo "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];?>" data-layout="button_count" data-size="small" data-mobile-iframe="true">
							<a class="fb-xfbml-parse-ignore" target="_blank">Chia sẻ</a></div></li>
					</ul>
					<ul class="nav navbar-nav pull-right actions-nav">
				        <li class="dropdown">
				          	<i class="fa fa-ellipsis-h" aria-hidden="true"></i>
				          	<ul class="dropdown-menu">
				           		<li><a ng-click="requestAnswer()"><i class="fa fa-magic" aria-hidden="true"></i> Yêu cầu</a></li>
				            	<li ng-show="question.is_resolved == 1" class="action ">
									<a ng-click="changeResolve(0)" ><i class="fa fa-check-circle" aria-hidden="true" style="color: #007E33; font-size: 15px;"></i> Resolved</a></li>
								<li ng-show="question.is_resolved == 0" class="action ">
									<a ng-click="changeResolve(1)"><i class="fa fa-check-circle" aria-hidden="true" style="color: #ff4444; font-size: 15px;"></i> Not resolve</a></li>
								<li class="divider"></li>
				           		<li><a ng-click="editQuestion()">
									<i class="fa fa-edit" aria-hidden="true"></i> Sửa</a></li>
								<li><a ng-click="deleteQuestion(question.id)">
									<i class="fa fa-trash" aria-hidden="true"></i> Xoá</a></li>
				          </ul>
				        </li>
				      </ul>
					@endverbatim
						@include('questions.directives.question_modal')
					@verbatim
				</div> 
			</div>
		</div>
		<div class="col-md-12" ng-show="isLogged == false" style="margin-top: 20px;">
			<a href="/login">Đăng nhập để tham gia trả lời và bình luận →</a>
		</div>
		<div class="col-md-12">
			<div class="row answer-list">
				<p ng-hide="answers_count == 0" class="filter-title">{{answers_count}} Trả lời</p>
				<!--best answer -->
				<div ng-if="question.bestAnswer">
					<best-answer></best-answer>
				</div>
			    <div class="text-center" ng-show="current_answer_page < last_answer_page" style="float: left; margin-top: 20px; padding: 20px;">
					<a ng-click="loadMoreAnswers()"><i ng-show="isloadingQa === 1"  class="fa fa-spinner spinning" aria-hidden="true"></i>Xem thêm trả lời</a>
				</div>
			    <div ng-hide="total == 0" class="col-md-12" ng-repeat="answer in answers | orderBy : 'id'">
					<answer-item></answer-item>
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
			</div>
		</div>
		@endverbatim
	</div>
</div>

@endsection