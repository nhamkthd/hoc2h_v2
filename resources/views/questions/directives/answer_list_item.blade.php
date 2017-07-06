@verbatim
<div class="media list-item-block">
	<span class="pull-left">
		<img src="" width="40" height="40">
	</span>
	<div class="modal fade" id="{{answer.id}}" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Sửa trả lời</h4>
				</div>
				<div class="modal-body">
					<div ckeditor="options" ng-model="edit_answer_content[$index]" ready="onReady()"></div>
				</div>
				<div class="modal-footer">
					<button data-dismiss="modal" class="btn btn-warning">Huỷ bỏ</button>
					<button data-dismiss="modal" class="btn btn-info" ng-click="editAnswer($index)">Lưu thay đổi</button>
				</div>
			</div>
		</div>
	</div>
	<div class="media-body">
		<div class="media-heading">
			<a href class="primary-text">{{answer.user.user_name}}</a>
			<small class="pull-right" style="color:#aa66cc; font-size: 12px;"> {{answer.created_at}}</small>
		</div>
		<div class="">
			<p class="answer-body" ng-bind-html="convertHtml(answer.content)">{{answer.content}}</p>
		</div>
		<div class="post-info" ng-show="user.id == answer.user_id">
			<ul class="nav nav-pills" role="tablist">
				<li class="action">
					<a data-toggle="modal" data-target="#{{answer.id}}" ng-click="showEditAnswerModal($index)">
						<i class="fa fa-edit" aria-hidden="true"></i> Sửa 
					</a>
				</li>
				<li class="action">
					<a confirm-delete="Delete Answer?" ng-click="deleteAnswer($index)">
						<i class="fa fa-trash" aria-hidden="true"></i> Xoá 
					</a>
				</li>
			</ul>
		</div> 
		<div class=" post-action">
			<ul class="nav nav-pills " role="tablist">
				<li ng-show ="answers.voted[answer.id] == 0"><a href ng-click="voteAnswer(answer.id)"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Thích <span class="badge ">{{answers.voteCount[answer.id]}}</span> </a></li>
				<li ng-show ="answers.voted[answer.id] == 1">
					<a href ng-click="voteAnswer(answer.id)">
						<i class="fa fa-thumbs-down" aria-hidden="true"></i> 
						Bỏ thích <span class="badge ">{{answers.voteCount[answer.id]}}</span> 
					</a>
				</li>
				<li >
					<a href ng-click="showComments(answer.id)">
						<i class="fa fa-comment" aria-hidden="true"></i> 
						Bình luận <span class="badge">{{answers.commentCount[answer.id]}}</span>
					</a> 
				</li>
			</ul>
		</div>
		<div class="comment-block" ng-show="showComments[answer.id]">
			<div class="comment-block-item" ng-repeat="comment in answers.comments[answer.id].comments">
				<span class="pull-left avt">
					<img src="" width="40" height="40">
				</span>
				<div class="media-body">
					<div class="media-heading">
						<a href class="primary-text">{{answers.comments[answer.id].users[comment.id].user_name}}</a>
						<span style="color:#aa66cc; font-size: 12px;">({{comment.created_at | date : "dd-MM-yyyy"}})</span>
					</div>
					<div class="">
						<div ng-show="comment_editing[$index] != 1">{{comment.content}}</div>
						<div ng-show="comment_editing[$index] === 1">
							<textarea id="comment_field" class="form-control" 
							  ng-model="comment_editing_field[$index]" 
							  enter-submit="editComment($index,answer.id)"></textarea>
						</div>
					</div>
					<div class="post-info" ng-show="user.id == answers.comments[answer.id].users[comment.id].id">
						<ul class="nav nav-pills" role="tablist">
							<li ng-show = "comment_editing[$index] != 1" class="action"><a ng-click="editCommentMode($index,answer.id)"><i class="fa fa-edit" aria-hidden="true" ></i> Sửa </a></li>
							<li ng-show = "comment_editing[$index] != 1" class="action">
								<a confirm-delete="Delete comment?" ng-click="deleteComment($index,answer.id)">
									<i class="fa fa-trash" aria-hidden="true"></i>
									Xoá
								</a>
							</li>
							<li ng-show="comment_editing[$index] === 1" class="action"><a ng-click="editComment($index,answer.id)"><i class="fa fa-save" aria-hidden="true"></i> Lưu lại </a></li>
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
							<li ng-show ="answers.comments[answer.id].voted[comment.id] == 0">
								<a href ng-click="voteComment(comment.id,answer.id)">
									<i class="fa fa-thumbs-up" aria-hidden="true"></i> 
									Thích <span class="badge ">{{answers.comments[answer.id].voteCount[comment.id]}}</span>
								</a>
							</li>
							<li ng-show ="answers.comments[answer.id].voted[comment.id] == 1">
								<a href ng-click="voteComment(comment.id,answer.id)">
									<i class="fa fa-thumbs-down" aria-hidden="true"></i> 
									Bỏ thích <span class="badge ">{{answers.comments[answer.id].voteCount[comment.id]}}</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="comment-box">
				<span class="pull-left avt">
					<img src="" width="40" height="40">
				</span>
				<div class="media-body">
					<textarea id="comment_field" class="form-control" placeholder="Viết bình luận..." 
							  ng-model="comment_content_field[$index]" 
							  enter-submit="addComment($index,answer.id)"></textarea>
				</div>
				<button style="margin-top:10px;" type="button"
						class="btn btn-outline-default waves-effect pull-right"  
						ng-click="addComment($index,answer.id)">
						Gửi bình luận</button>
			</div>
		</div>
	</div>
</div>
@endverbatim