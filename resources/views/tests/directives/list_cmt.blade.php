@verbatim
<div class="media list-item-block">
	<span class="pull-left">
		<img src="{{cmt.user.avatar}}" width="40" height="40">
	</span>
	<div class="modal fade" id="{{cmt.id}}" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Sửa trả lời</h4>
				</div>
				<div class="modal-body">
					<textarea ng-init="editComment[$index]=cmt.content" ng-model='editComment[$index]'></textarea>
				</div>
				<div class="modal-footer">
					<button data-dismiss="modal" class="btn btn-warning">Huỷ bỏ</button>
					<button data-dismiss="modal" class="btn btn-info" ng-click="saveComment($index)">Lưu thay đổi</button>
				</div>
			</div>
		</div>
	</div>
	<div class="media-body"  id="anchor{{cmt.id}}" ng-class="{anchorAt:anchorAt === cmt.id}">
		<div class="media-heading">
			<a href class="primary-text">{{cmt.user.name}}</a>
			<small class="pull-right" style="color:#aa66cc; font-size: 12px;"> {{cmt.date_created}}</small>
		</div>
		<div class="">
			<p class="answer-body">{{cmt.content}}</p>
		</div>
		<div class="post-info" ng-show="user.id == cmt.user_id">
			<ul class="nav nav-pills" role="tablist">
				<li class="action">
					<a data-toggle="modal" data-target="#{{cmt.id}}" ng-click="showEditAnswerModal($index)">
						<i class="fa fa-edit" aria-hidden="true"></i> Sửa 
					</a>
				</li>
				<li class="action">
					<a confirm-delete="Delete Answer?" ng-click="deleteCmt($index,cmt.id)">
						<i class="fa fa-trash" aria-hidden="true"></i> Xoá 
					</a>
				</li>
			</ul>
		</div> 
		<div class=" post-action">
			<ul class="nav nav-pills " role="tablist">
				<li ng-show ="cmt.user_like.indexOf(user.id)==-1||cmt.like==[]"><a href ng-click="likeComment($index,cmt.id)"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Thích <span class="badge ">{{cmt.user_like.length}}</span> </a></li>
				<li ng-show ="cmt.user_like.indexOf(user.id)!=-1">
					<a href ng-click="dislikeComment($index,cmt.id)">
						<i class="fa fa-thumbs-down" aria-hidden="true"></i> 
						Bỏ thích <span class="badge ">{{cmt.user_like.length}}</span> 
					</a>
				</li>
			</ul>
		</div>
		
	</div>
</div>
@endverbatim