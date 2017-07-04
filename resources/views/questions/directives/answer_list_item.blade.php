@verbatim
<div class="media list-item-block">
	<span class="pull-left">
		<img src="" width="40" height="40">
	</span>
	<div class="media-body">
		<div class="media-heading">
			<a href class="default-color">{{answer.user.user_name}}</a>
			<small class="pull-right"> 11 phút trước</small>
		</div>
		<div class="">
			<p class="answer-body" ng-bind-html="convertHtml(answer.content)">{{answer.content}}</p>
		</div>
		<div class=" post-action">
			<ul class="nav nav-pills " role="tablist">
				<li ng-show ="answers.voted[answer.id] == 0"><a href ng-click="voteAnswer(answer.id)"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Thích <span class="badge ">{{answers.voteCount[answer.id]}}</span> </a></li>
				<li ng-show ="answers.voted[answer.id] == 1"><a href ng-click="voteAnswer(answer.id)"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Bỏ thích <span class="badge ">{{answers.voteCount[answer.id]}}</span> </a></li>
				<li ><a href ng-click="comments(answer.id)"><i class="fa fa-comment" aria-hidden="true"></i> Bình luận <span class="badge">{{answers.commentCount[answer.id]}}</span></a> </li>
				<li ><a href=""><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a> </li>
			</ul>
		</div>
		<div class="comment-block" ng-show="comment_box_id === answer.id">
			<div class="comment-block-item" ng-repeat="comment in answers.comments[answer.id].comments">
				<span class="pull-left avt">
					<img src="" width="40" height="40">
				</span>
				<div class="media-body">
					<div class="media-heading">
						<a href class="default-color">{{answers.comments[answer.id].users[comment.id].user_name}}</a>
					</div>
					<div class="">
						{{comment.content}}
					</div>
					<div class=" post-action" style="border-bottom:solid 1px #e0e0e0;">
						<ul class="nav nav-pills " role="tablist">
							<li ng-show ="answers.comments[answer.id].voted[comment.id] == 0"><a href ng-click="voteComment(comment.id,answer.id)"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Thích <span class="badge ">{{answers.comments[answer.id].voteCount[comment.id]}}</span> </a></li>
							<li ng-show ="answers.comments[answer.id].voted[comment.id] == 1"><a href ng-click="voteComment(comment.id,answer.id)"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Bỏ thích <span class="badge ">{{answers.comments[answer.id].voteCount[comment.id]}}</span> </a></li>
							<li ng-show="user.id == answer.user_id" >
								<a href ng-click="showCommentDropMenu(comment.id)"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a> 
								<ul class="dropMenu" ng-show="comment_menu_id === comment.id">
									<li>Sửa</li>
									<li>Xoá</li>
								</ul>
							</li>
							<li class="pull-right"> 11 phút trước</li>
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
				<button style="margin-top:10px;" class="btn btn-main pull-right" type="button" ng-click="addComment(answer.id)">Gửi bình luận</button>
			</div>
		</div>
	</div>
</div>
@endverbatim