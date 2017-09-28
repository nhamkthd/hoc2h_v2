				<div ng-if="has_bestAnswer" class="best-answer-panel" id="anchor{{question.bestAnswer.id}}">	
					<h5 class="panel-title">Câu trả lời tốt nhất</h5>
					<div class="panel-body">
						<span class="pull-left">
							<img class="small-avt" src="{{question.bestAnswer.user.avatar}}" width="40" height="40">
						</span>
						<div class="media-body">
							<div class="media-heading">
								<a href="/users/{{question.bestAnswer.user.id}}/profile" class="primary-text">{{question.bestAnswer.user.name}}</a>
								
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