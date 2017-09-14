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
				<div ng-show="question.bestAnswer != null" class="best-answer-panel" id="anchor{{question.bestAnswer.id}}">
					<h5 class="panel-title">Câu trả lời tốt nhất</h5>
					<div class="panel-body">
						<span class="pull-left">
							<img class="small-avt" src="{{question.bestAnswer.user.avatar}}" width="40" height="40">
						</span>
						<div class="media-body">
							<div class="media-heading">
								<a href="/users/{{question.bestAnswer.user.id}}/profile" class="primary-text">{{question.bestAnswer.user.name}}</a>
								<span ng-show="question.bestAnswer.user.class"> - học {{question.bestAnswer.user.class}}</span>
							</div>
							<p class="answer-body" ng-class="{anchorAt:anchorAt === question.bestAnswer.id}" 
													ng-bind-html="convertHtml(question.bestAnswer.content)">{{question.bestAnswer.content}}</p>

							<div class="post-info">
								<ul class="nav nav-pills" role="tablist">
									<li ng-class="{voted:question.bestAnswer.isVoted == 1}" 
											ng-click="voteAnswer(question.bestAnswer.index)">
											<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
											Thích <span>{{question.bestAnswer.votes_count}}</span></li>
									<li href ng-click="showComments(question.bestAnswer.id)">
											<i class="fa fa-comment-o" aria-hidden="true"></i>
											Bình luận <span>{{question.bestAnswer.votes_count}}</span></li>
									<li ng-show="user.id == question.user.id" ng-click="setBestAnswer(question.bestAnswer.index,0)">
											<i class="fa fa-close color-danger-dark" aria-hidden="true"></i>
											Not best answer</li>
									<li><span class="date-created"><i class="fa fa-clock-o" aria-hidden="true"></i> {{question.bestAnswer.date_created}}</span></li>
								</ul>
								<ul class="nav nav-pills pull-right" role="tablist" ng-show="user.id == question.bestAnswer.user_id">
									<li class="action" ng-click="editAnswer(question.bestAnswer.index)">
											<i class="fa fa-edit" aria-hidden="true"></i> Sửa </li>
									<li class="action" ng-click="deleteAnswer(question.bestAnswer.index)">
											<i class="fa fa-trash" aria-hidden="true"></i> Xoá </li>
								</ul>
							</div> 
							<div class="comment-block" ng-show="showComments[question.bestAnswer.id]">
								<div class="comment-block-item" ng-repeat="comment in question.bestAnswer.comments">
									<span class="pull-left avt">
										<img class="small-avt" src="{{comment.user.avatar}}" width="40" height="40">
									</span>
									<div class="media-body">
										<div class="media-heading">
											<a href="/users/{{comment.user.id}}/profile" class="primary-text">{{comment.user.name}}</a>
											<span ng-show="comment.user.class">- học {{comment.user.class}}</span>
											
										</div>
										<div class="">
											<div ng-show="comment_editing[$index] != 1"><p class="answer-body">{{comment.content}}</p></div>
											<div ng-show="comment_editing[$index] === 1">
												<textarea id="comment_field" class="form-control" 
												  ng-model="comment_editing_field[$index]" 
												  enter-submit="editComment($index,$parent.answers.indexOf(answer))"></textarea>
											</div>
										</div>
										<div class="post-info">
											<ul class="nav nav-pills " role="tablist">
												<li ng-class="{voted:comment.isVoted == 1}" ng-click="voteComment($index,question.bestAnswer.index)">
														<i class="fa fa-thumbs-up" aria-hidden="true"></i> 
														Thích <span>{{comment.votes_count}}</span></li>
												<li><span class="date-created"><i class="fa fa-clock-o" aria-hidden="true"></i> {{comment.date_created}}</span></li>
											</ul>
											<ul class="nav nav-pills pull-right" role="tablist" ng-show="user.id == comment.user.id">
												<li ng-show = "comment_editing[$index] != 1" class="action" 
													ng-click="editCommentMode($index,question.bestAnswer.index)"><i class="fa fa-edit" aria-hidden="true" ></i> Sửa</li>
												<li ng-show = "comment_editing[$index] != 1" class="action"
													confirm-delete="Delete comment?" ng-click="deleteComment($index,question.bestAnswer.index)">
														<i class="fa fa-trash" aria-hidden="true"></i>Xoá</li>
												<li ng-show="comment_editing[$index] === 1" class="action"
													ng-click="editComment($index,question.bestAnswer.index)"><i class="fa fa-save" aria-hidden="true"></i> Lưu lại</li>
												<li ng-show="comment_editing[$index] === 1" class="action" 
													ng-click="cancelEditComment($index)">
													<i class="fa fa-close" aria-hidden="true"></i> Huỷ bỏ</li>

											</ul>
										</div>
									</div>
								</div>
								<div class="comment-box" ng-show="isLogged == true">
									<div class="dot-spinner" ng-show="comment_adding[$index] == 1">
									  <div class="bounce1"></div>
									  <div class="bounce2"></div>
									  <div class="bounce3"></div>
									</div>
									<span class="pull-left avt">
										@endverbatim
											@if(Auth::check())
											<img class="small-avt" src="{{Auth::user()->avatar}}" width="40" height="40">
											@endif
										@verbatim
									</span>
									<div class="media-body">
										<textarea id="comment_field" class="form-control" placeholder="Viết bình luận..." 
												  ng-model="comment_content_field[question.bestAnswer.index]" 
												  enter-submit="addComment(question.bestAnswer.index)"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			    <div class="text-center" ng-show="current_answer_page < last_answer_page" style="float: left; margin-top: 20px; padding: 20px;">
					<a ng-click="loadMoreAnswers()"><i ng-show="isloadingQa === 1"  class="fa fa-spinner spinning" aria-hidden="true"></i>Xem thêm trả lời</a>
				</div>
			    <div ng-hide="total == 0" class="col-md-12" ng-repeat="answer in answers | orderBy : 'id'">
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
			</div>
		</div>
		@endverbatim
	</div>
</div>

@endsection