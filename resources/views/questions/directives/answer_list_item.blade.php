@verbatim
<div class="media list-item-block">
	<span class="pull-left">
		<img src="" width="40" height="40">
	</span>
	<div class="media-body">
		<div class="media-heading">
			<a href class="primary-text">{{answer.user.user_name}}</a>
			<small class="pull-right" style="color:#aa66cc; font-size: 12px;"> 11 phút trước</small>
		</div>
		<div class="">
			<p class="answer-body" ng-bind-html="convertHtml(answer.content)">{{answer.content}}</p>
		</div>
		<div class="post-info" ng-show="user.id == question.user_id">
			<ul class="nav nav-pills" role="tablist">
				<li class="action"><a><i class="fa fa-edit" aria-hidden="true"></i> Sửa </a></li>
				<li class="action"><a data-toggle="modal" data-target="#delete_answer_m"><i class="fa fa-close" aria-hidden="true"></i> Xoá </a></li>
				<div class="modal fade" id="delete_answer_m" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title text-center"><i class="fa fa-warning danger-text" aria-hidden="true"></i> Bạn thật sự muốn xoá câu hỏi này!</h4>
							</div>
							<div class="modal-footer">
								<button class="btn btn-warning" ng-click="deleteAnswer($index)" data-dismiss="modal">Vẫn xoá</button>
								<button data-dismiss="modal" class="btn btn-info">Thôi</button>
							</div>
						</div>
					</div>
				</div>
			</ul>
		</div> 
		<div class=" post-action">
			<ul class="nav nav-pills " role="tablist">
				<li ng-show ="answers.voted[answer.id] == 0"><a href ng-click="voteAnswer(answer.id)"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Thích <span class="badge ">{{answers.voteCount[answer.id]}}</span> </a></li>
				<li ng-show ="answers.voted[answer.id] == 1"><a href ng-click="voteAnswer(answer.id)"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Bỏ thích <span class="badge ">{{answers.voteCount[answer.id]}}</span> </a></li>
				<li ><a href ng-click="showComments(answer.id)"><i class="fa fa-comment" aria-hidden="true"></i> Bình luận <span class="badge">{{answers.commentCount[answer.id]}}</span></a> </li>
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
						<span style="color:#aa66cc; font-size: 12px;">11 phút trước</span>
					</div>
					<div class="">
						{{comment.content}}
					</div>
					<div class="post-info" ng-show="user.id == question.user_id">
						<ul class="nav nav-pills" role="tablist">
							<li class="action"><i class="fa fa-edit" aria-hidden="true"></i> Sửa</li>
							<li class="action"><i class="fa fa-close" aria-hidden="true"></i> Xoá</li>
						</ul>
					</div> 
					<div class=" post-action" style="border-bottom:solid 1px #e0e0e0;">
						<ul class="nav nav-pills " role="tablist">
							<li ng-show ="answers.comments[answer.id].voted[comment.id] == 0"><a href ng-click="voteComment(comment.id,answer.id)"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Thích <span class="badge ">{{answers.comments[answer.id].voteCount[comment.id]}}</span> </a></li>
							<li ng-show ="answers.comments[answer.id].voted[comment.id] == 1"><a href ng-click="voteComment(comment.id,answer.id)"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Bỏ thích <span class="badge ">{{answers.comments[answer.id].voteCount[comment.id]}}</span> </a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="comment-box">
				<span class="pull-left avt">
					<img src="" width="40" height="40">
				</span>
				<div class="media-body">
					<textarea id="comment_field" ng-model="comment_content" class="form-control" placeholder="Viết bình luận..."></textarea>
				</div>
				<button style="margin-top:10px;" class="btn btn-outline-default waves-effect pull-right" type="button" ng-click="addComment(answer.id)">Gửi bình luận</button>
			</div>
		</div>
	</div>
</div>
@endverbatim