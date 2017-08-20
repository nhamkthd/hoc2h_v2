@verbatim
<div class="media list-item-block"  id="anchor{{answer.id}}" ng-class="{anchorAt:anchorAt === answer.id}">
	<span class="pull-left">
		<img src="{{answer.user.avatar}}" width="40" height="40">
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
			<span class="date-created pull-right"><i class="fa fa-clock-o" aria-hidden="true"></i> {{answer.date_created}}</span>
		</div>
		<div class="">
			<p class="answer-body" ng-bind-html="convertHtml(answer.content)">{{answer.content}}</p>
		</div>
		<div class="post-info" ng-show="user.id == answer.user_id">
			<ul class="nav nav-pills" role="tablist">
				<li class="action">
					<a ng-click="editAnswer($index)">
						<i class="fa fa-edit" aria-hidden="true"></i> Sửa 
					</a>
				</li>
				<li class="action">
					<a ng-click="deleteAnswer($index)">
						<i class="fa fa-trash" aria-hidden="true"></i> Xoá 
					</a>
				</li>
			</ul>
		</div> 
		<div class=" post-action">
			<ul class="nav nav-pills " role="tablist">
				<li ng-show ="answer.isVoted == 0"><a href ng-click="voteAnswer($index)"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Thích <span class="badge ">{{answer.votes_count}}</span> </a></li>
				<li ng-show ="answer.isVoted == 1">
					<a href ng-click="voteAnswer($index)">
						<i class="fa fa-thumbs-down" aria-hidden="true"></i> 
						Bỏ thích <span class="badge ">{{answer.votes_count}}</span> 
					</a>
				</li>
				<li >
					<a href ng-click="showComments(answer.id)">
						<i class="fa fa-comment" aria-hidden="true"></i> 
						Bình luận <span class="badge">{{answer.comments_count}}</span>
					</a> 
				</li>
			</ul>
		</div>
		<div class="comment-block" ng-show="showComments[answer.id]">
			<div class="comment-block-item" ng-repeat="comment in answer.comments">
				<span class="pull-left avt">
					<img src="{{comment.user.avatar}}" width="40" height="40">
				</span>
				<div class="media-body">
					<div class="media-heading">
						<a href="/users/{{comment.user.id}}/profile" class="primary-text">{{comment.user.name}}</a>
						<span class="date-created"><i class="fa fa-clock-o" aria-hidden="true"></i> {{comment.date_created}}</span>
					</div>
					<div class="">
						<div ng-show="comment_editing[$index] != 1"><p class="answer-body">{{comment.content}}</p></div>
						<div ng-show="comment_editing[$index] === 1">
							<textarea id="comment_field" class="form-control" 
							  ng-model="comment_editing_field[$index]" 
							  enter-submit="editComment($index,$parent.$index)"></textarea>
						</div>
					</div>
					<div class="post-info" ng-show="user.id == comment.user.id">
						<ul class="nav nav-pills" role="tablist">
							<li ng-show = "comment_editing[$index] != 1" class="action"><a ng-click="editCommentMode($index,$parent.$index)"><i class="fa fa-edit" aria-hidden="true" ></i> Sửa </a></li>
							<li ng-show = "comment_editing[$index] != 1" class="action">
								<a confirm-delete="Delete comment?" ng-click="deleteComment($index,$parent.$index)">
									<i class="fa fa-trash" aria-hidden="true"></i>
									Xoá
								</a>
							</li>
							<li ng-show="comment_editing[$index] === 1" class="action"><a ng-click="editComment($index,$parent.$index)"><i class="fa fa-save" aria-hidden="true"></i> Lưu lại </a></li>
							<li ng-show="comment_editing[$index] === 1" class="action">
								<a  ng-click="cancelEditComment($index)">
									<i class="fa fa-close" aria-hidden="true"></i> 
									Huỷ bỏ
								</a>
							</li>

						</ul>
					</div> 
					<div class=" post-action" style="border-bottom:solid 1px #e0e0e0;">
						<ul class="nav nav-pills " role="tablist">
							<li ng-show ="comment.isVoted == 0">
								<a href ng-click="voteComment($index,$parent.$index)">
									<i class="fa fa-thumbs-up" aria-hidden="true"></i> 
									Thích <span class="badge ">{{comment.votes_count}}</span>
								</a>
							</li>
							<li ng-show ="comment.isVoted == 1">
								<a href ng-click="voteComment($index,$parent.$index)">
									<i class="fa fa-thumbs-down" aria-hidden="true"></i> 
									Bỏ thích <span class="badge ">{{comment.votes_count}}</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="comment-box" ng-show="isLogged == true">
				<span class="pull-left avt">
					@endverbatim
					<img src="{{Auth::user()->avatar}}" width="40" height="40">
					@verbatim
				</span>
				<div class="media-body">
					<textarea id="comment_field" class="form-control" placeholder="Viết bình luận..." 
							  ng-model="comment_content_field[$index]" 
							  enter-submit="addComment($index)"></textarea>
				</div>
			</div>
		</div>
	</div>
</div>
@endverbatim