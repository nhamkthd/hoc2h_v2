@verbatim
<div class="col-md-12 tab-content">
	<div class="row">
		<div class="col-md-3" id="side-menu">
			<ul>
				<li class="category">Tổng quan
					<ul>
						<li><a ng-click="setActivityTab(1)" ng-class="{active:activityTab === 1}" href="">Thống kê chung</a></li>
						<li><a ng-click="setActivityTab(8)" ng-class="{active:activityTab === 8}" href="">Lịch sử hoạt động</a></li>
					</ul>
				</li>

				<li class="category">Hỏi đáp
					<ul>
						<li><a ng-click="setActivityTab(2)" ng-class="{active:activityTab === 2}" href="">Câu hỏi</a></li>
						<li><a ng-click="setActivityTab(3)" ng-class="{active:activityTab === 3}" href="">Câu trả lời </a></li>
						<li><a ng-click="setActivityTab(4)" ng-class="{active:activityTab === 4}" href="">Được đề xuất trả lời </a></li>
					</ul>
				</li>
				<li class="category">Đề Thi
					<ul>
						<li><a ng-click="setActivityTab(5)" ng-class="{active:activityTab === 5}" href="">Đề tạo</a></li>
						<li><a ng-click="setActivityTab(6)" ng-class="{active:activityTab === 6}" href="">Đề đã làm</a></li>
					</ul>
				</li>
				<li class="category">Tài liệu 
					<ul>
						<li><a ng-click="setActivityTab(7)" ng-class="{active:activityTab === 7}" href="">Danh sách theo dõi</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<div ng-show="activityTab === 1">
			<div class="col-md-9">
				<div class="active-panel">
					<div class="panel-header">
						<h3 class="title-section">Câu hỏi
							<span>({{over_view_counts[0]}})</span>
						</h3>
					</div>
					<div class="panel-content">
						<table class="panel-content-table">
							<tbody>
								<tr ng-repeat="question in questions_overview">
									<td class="count-cell">
										<div class="mini-counts">{{question.votes_count}}</div>
									</td>
									<td >
										<a class="title-hyperlink" href="/questions/question/{{question.id}}">{{question.title}}</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="active-panel-footer" ng-hide="over_view_counts[0] <= 10">
						<a ng-click="setActivityTab(2)" href="">Xem thêm →</a>
					</div>
				</div>
				<div class="active-panel">
					<div class="panel-header">
						<h3 class="title-section">Trả lời
							<span>({{over_view_counts[1]}})</span>
						</h3>
					</div>
					<div class="panel-content">
						<table class="panel-content-table">
							<tbody>
								<tr ng-repeat = "answer in answers_overview">
									<td class="count-cell">
										<div class="mini-counts">{{answer.votes_count}}</div>
									</td>
									<td >
										<a class="title-hyperlink" href="/questions/question/{{answer.question.id}}/{{answer.id}}">{{answer.question.title}}</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="active-panel-footer" ng-hide="over_view_counts[1] <= 10">
						<a href="">Xem thêm →</a>
					</div>
				</div>
				<div class="active-panel">
					<div class="panel-header">
						<h3 class="title-section">Đề đã làm 
							<span>{{(over_view_counts[2])}}</span>
						</h3>
					</div>
					<div class="panel-content">
						<table class="panel-content-table">
							<tbody>
								<tr>
									<td class="count-cell">
										<div class="mini-counts">12</div>
									</td>
									<td class="title-hyperlink">
										<a  href="">C# programming on macOS</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="active-panel-footer" ng-hide="over_view_counts[2] <= 10">
						<a href="">Xem thêm →</a>
					</div>
				</div>
			</div>
		</div>
		<div ng-show="activityTab === 2">
			<div class="col-md-9">
				<div class="sub-tab-header full-tab-header">
					<h3>
						<span>{{over_view_counts[0]}}</span> Câu hỏi
					</h3>
					<div class="sub-tabs sub-tab-sort">
						<span ng-class="{sortSelected:questionSortTab === 1}" ng-click = "setQuestionSortTab(1)">Nổi bật</span>
						<span ng-class="{sortSelected:questionSortTab === 2}" ng-click = "setQuestionSortTab(2)">Mới đăng</span>
						<span ng-class="{sortSelected:questionSortTab === 3}" ng-click = "setQuestionSortTab(3)">Đã giải quyết</span>
					</div>
				</div>
				<div class="sub-tab-content">
					<div class="user-questions">
						<div ng-repeat="question in user_questions" class="question-summary narrow">
							<div class="row">
								<div class="col-md-3 question-counts cp">
									<div class="row">
										<div class="col-md-4 couts-detail">
											<div class="mini-counts">{{question.votes_count}}</div>
											<div>Thích</div>
										</div>
										<div class="col-md-4 couts-detail ">
											<div class="mini-counts">{{question.answers_count}}</div>
											<div>Trả lời</div>
										</div>
										<div class="col-md-4 couts-detail">
											<div class="mini-counts">{{question.views_count}}</div>
											<div>Xem</div>
										</div>
									</div>
								</div>
								<div class="col-md-9 question-summary-detail">
									<a class="title-hyperlink" href="/questions/question/{{question.id}}">{{question.title}}</a>
									<div class="card-tags" ng-hide="question.tags.length == 0" style="margin-left:-.5rem;" >
										<ul>
											<li ng-repeat="tag in question.tags">
											<a href="/questions/tagged/?id={{tag.id}}">{{tag.name}}</a></li>
										</ul>
									</div>
									<span class="created_date">
										<i class="fa fa-clock-o" aria-hidden="true"></i> 
										{{question.created_at}}</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div ng-show="activityTab === 3">
			<div class="col-md-9">
				<div class="sub-tab-header full-tab-header">
					<h3>
						<span>{{over_view_counts[1]}}</span> Câu trả lời
					</h3>
					<div class="sub-tabs sub-tab-sort">
						<span ng-class="{sortSelected:answerSortTab === 1}" ng-click = "setAnswerSortTab(1)">Nổi bật</span>
						<span ng-class="{sortSelected:answerSortTab === 2}" ng-click = "setAnswerSortTab(2)">Mới nhất</span>
						<span ng-class="{sortSelected:answerSortTab === 3}" ng-click = "setAnswerSortTab(3)">Bests</span>
					</div>
				</div>
				<div class="sub-tab-content">
					<div class="user-answers">
						<div class="row answer-summary" ng-repeat="answer in user_answers">
							<div class="col-md-1">
								<div class="answer-votes">{{answer.votes_count}}</div>
							</div>
							<div class="col-md-11" style="padding: 0;">
								<div class="answer-link">
									<a class="title-hyperlink pull-left"  href="/questions/question/{{answer.question.id}}/{{answer.id}}">{{answer.question.title}}</a>
									<span class="created_date pull-right">{{answer.created_at}}</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endverbatim