@verbatim
<div class="media list-item-block"  id="anchor{{answer.id}}" >
	<span class="pull-left">
		<img class="small-avt" src="{{answer.user.avatar}}" width="40" height="40">
	</span>
	<script type="text/ng-template" id="editAnswerModal.html">
		<div class="modal-header">
			<h3 class="modal-title" id="modal-title"><i class="fa fa-edit" aria-hidden="true"></i> Sửa câu trả lời</h3>
		</div>
		<div class="modal-body" id="modal-body">
			<div ckeditor="options" ng-model="edit_answer_content" ready="onReady()"></div>
		</div>
		<div class="modal-footer">
			<button class="btn btn-warning" type="button" ng-click="cancel()">Huỷ bỏ</button>
			<button class="btn btn-primary" type="button" ng-click="submit()">Lưu lại</button>
		</div>
	</script>
	<script type="text/ng-template" id="deleteAnswerModal.html">
		<div class="modal-header">
			<h4 class="modal-title text-center" id="modal-title"><i class="fa fa-warning danger-dark-text" aria-hidden="true"></i> Bạn thật sự muốn xoá câu trả lời này...!</h4>
		</div>
		<div class="modal-footer">
			<button class="btn btn-warning" type="button" ng-click="cancel()">Huỷ bỏ</button>
			<button class="btn btn-primary" type="submit" ng-click="submit()">Vẫn xoá</button>
		</div>
	</script>
	<div class="media-body">
		<div class="media-heading">
			<a href="/users/{{answer.user.id}}/profile" class="primary-text">{{answer.user.name}}</a>
			<span ng-show="answer.user.class"> - học {{answer.user.class}}</span>
			<span class="date-created pull-right"><i class="fa fa-clock-o" aria-hidden="true"></i> {{answer.date_created}}</span>
		</div>
		<p class="answer-body" ng-class="{best:answer.is_best == 1 , anchorAt:anchorAt === answer.id}" ng-bind-html="convertHtml(answer.content)">{{answer.content}}</p>

		<div class="post-info">
			<ul class="nav nav-pills" role="tablist">
				<li >
					<a ng-class="{voted:answer.isVoted == 1}" ng-click="voteAnswer(answers.indexOf(answer))">
						<i ng-show="isAnswerVoting[answers.indexOf(answer)] === 1" class="fa fa-spinner spinning" aria-hidden="true"></i>
					  	<i class="fa fa-thumbs-up" aria-hidden="true"></i> 
						Thích <span>{{answer.votes_count}}</span> 
					</a>
				</li>
				<li >
					<a href ng-click="showComments(answer.id)">
						<i class="fa fa-comment" aria-hidden="true"></i> 
						Bình luận <span>{{answer.comments_count}}</span>
					</a> 
				</li>
				<li ng-show="user.id == question.user.id && answer.is_best == 0 && question.haveBestAnswer == 0">
					<a ng-click="setBestAnswer(answers.indexOf(answer),1)">
						<i class="fa fa-check" aria-hidden="true" style="color: gray;"></i>
						Best answer
					</a> 
				</li>
				<li ng-show="user.id == question.user.id && answer.is_best == 1">
					<a ng-click="setBestAnswer(answers.indexOf(answer),0)">
						<i class="fa fa-check " aria-hidden="true" style="color: green;"></i>
						Best answer
					</a> 
				</li>
			</ul>
			<ul class="nav nav-pills pull-right" role="tablist" ng-show="user.id == answer.user_id">
				<li class="action">
					<a ng-click="editAnswer(answers.indexOf(answer))">
						<i class="fa fa-edit" aria-hidden="true"></i> Sửa 
					</a>
				</li>
				<li class="action">
					<a ng-click="deleteAnswer(answers.indexOf(answer))">
						<i class="fa fa-trash" aria-hidden="true"></i> Xoá 
					</a>
				</li>
			</ul>
		</div> 
		<div class="comment-block" ng-show="showComments[answer.id]">
			<div class="comment-block-item" ng-repeat="comment in answer.comments">
				<span class="pull-left avt">
					<img class="small-avt" src="{{comment.user.avatar}}" width="40" height="40">
				</span>
				<div class="media-body">
					<div class="media-heading">
						<a href="/users/{{comment.user.id}}/profile" class="primary-text">{{comment.user.name}}</a>
						<span ng-show="comment.user.class">- học {{comment.user.class}}</span>
						<span class="date-created pull-right"><i class="fa fa-clock-o" aria-hidden="true"></i> {{comment.date_created}}</span>
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
							<li>
								<a ng-class="{voted:comment.isVoted == 1}" ng-click="voteComment($index,$parent.answers.indexOf(answer))">
									<i class="fa fa-thumbs-up" aria-hidden="true"></i> 
									Thích <span>{{comment.votes_count}}</span>
								</a>
							</li>
						</ul>
						<ul class="nav nav-pills pull-right" role="tablist" ng-show="user.id == comment.user.id">
							<li ng-show = "comment_editing[$index] != 1" class="action"><a ng-click="editCommentMode($index,$parent.answers.indexOf(answer))"><i class="fa fa-edit" aria-hidden="true" ></i> Sửa </a></li>
							<li ng-show = "comment_editing[$index] != 1" class="action">
								<a confirm-delete="Delete comment?" ng-click="deleteComment($index,$parent.answers.indexOf(answer))">
									<i class="fa fa-trash" aria-hidden="true"></i>
									Xoá
								</a>
							</li>
							<li ng-show="comment_editing[$index] === 1" class="action"><a ng-click="editComment($index,$parent.answers.indexOf(answer))"><i class="fa fa-save" aria-hidden="true"></i> Lưu lại </a></li>
							<li ng-show="comment_editing[$index] === 1" class="action">
								<a  ng-click="cancelEditComment($index)">
									<i class="fa fa-close" aria-hidden="true"></i> 
									Huỷ bỏ
								</a>
							</li>

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
							  ng-model="comment_content_field[answers.indexOf(answer)]" 
							  enter-submit="addComment(answers.indexOf(answer))"></textarea>
				</div>
			</div>
		</div>
	</div>
</div>
@endverbatim