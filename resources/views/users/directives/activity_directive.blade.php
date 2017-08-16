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
						<li><a ng-click="setActivityTab(2)" ng-class="{active:activityTab === 2}" href="">Danh sách câu hỏi</a></li>
						<li><a ng-click="setActivityTab(3)" ng-class="{active:activityTab === 3}" href="">Danh sách câu trả lời </a></li>
						<li><a ng-click="setActivityTab(4)" ng-class="{active:activityTab === 4}" href="">Được đề xuất trả </a></li>
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
							<span>({{questions_overview.length}})</span>
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
					<div class="active-panel-footer">
						<a ng-click="setActivityTab(2)" href="">Xem thêm →</a>
					</div>
				</div>
				<div class="active-panel">
					<div class="panel-header">
						<h3 class="title-section">Trả lời
							<span>({{answers_overview.length}})</span>
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
										<a class="title-hyperlink" href="">{{answer.question.title}}</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="active-panel-footer">
						<a href="">Xem thêm →</a>
					</div>
				</div>
				<div class="active-panel">
					<div class="panel-header">
						<h3 class="title-section">Đề đã làm 
							<span>(120)</span>
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
					<div class="active-panel-footer">
						<a href="">Xem thêm →</a>
					</div>
				</div>
			</div>
		</div>
		<div ng-show="activityTab === 2">
			<div class="col-md-9">
				<div class="sub-tab-header full-tab-header">
					<h3>
						<span>11</span> Câu hỏi
					</h3>
					<div class="sub-tabs sub-tab-sort">
						<span ng-class="{active:questionSortTab === 1}" ng-click = "setQuestionSortTab(1)">Nổi bật</span>
						<span ng-class="{active:questionSortTab === 2}" ng-click = "setQuestionSortTab(2)">Mới đăng</span>
						<span ng-class="{active:questionSortTab === 3}" ng-click = "setQuestionSortTab(3)">Đã có trả lời</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endverbatim