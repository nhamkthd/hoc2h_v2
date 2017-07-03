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
				<li ng-show ="isVotedAnswer"><a href ng-click="voteAnswer(answer.id)"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Thích <span class="badge ">{{question_votes}}</span> </a></li>
				<li ng-show ="isVotedAnswer == 1"><a href ng-click="voteAnswer(answer.id)"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Bỏ thích </a></li>
				<li ><a href ng-click="comments()"><i class="fa fa-comment" aria-hidden="true"></i> Bình luận <span class="badge ">{{question_votes}}</span></a> </li>
				<li ><a href=""><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a> </li>
			</ul>
		</div>
		<div class="comment-item-block" ng-show="isShowComments == 1">
			<span class="pull-left avt">
				<img src="" width="40" height="40">
			</span>
			<div class="media-body">
				<div class="media-heading">
					Aries1992
				</div>
				<div class="">
					{{answer.content}}
				</div>
				<div class=" post-action">
					<ul class="nav nav-pills " role="tablist">
						<li ng-show ="isVotedComment== 0"><a href ng-click="voteComment()"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Thích <span class="badge ">{{question_votes}}</span> </a></li>
						<li ng-show ="isVotedComment == 1"><a href ng-click="voteCommnet()"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Bỏ thích </a></li>
						<li ng-show="user.id == answer.user_id" ><a href=""><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a> </li>
						<li style="margin-top:5px;"> 11 phút trước</li>
					</ul>
				</div>
			</div>
			<span class="pull-left avt">
				<img src="" width="40" height="40">
			</span>
			<div class="media-body">
				<textarea id="comment_field" ng-model="comment_content" class="form-control" placeholder="Viết bình luận..."></textarea>
			</div>
		</div>
		<button  ng-show="isShowComments == 1" style="font-size: 13px; margin-top: 10px;width: 10%; margin-right:10px;" class="btn btn-main pull-right" type="button" ng-click="addComment(answer_id)">Gửi</button>
	</div>
</div>
@endverbatim