
@verbatim
<div class="card-list">
	<div class="card-body">
		<div class="card-title">
			<a style="font-size: 15px;" href="/questions/question/{{question.id}}">{{question.title}} 
				<span ng-show="question.is_resolved == 1">
					<i class="fa fa-check-circle success-dark-text" aria-hidden="true"></i></span>
				<span ng-show="question.is_resolved == 0">
					<i class="fa fa-question-circle danger-dark-text" aria-hidden="true"></i></span></a>
		</div>
		<div class="card-summary">
		<p style="font-size: 13px;" ng-bind-html="question.content| textShortenerFilter: 260"></p>
		</div>
		<div class="card-tags" ng-hide="question.tags.length == 0" style="margin-left:-.5rem;" >
			<ul>
				<li ng-repeat="tag in question.tags">
				<a href="/questions/tagged/?id={{tag.id}}">{{tag.name}}</a></li>
			</ul>
		</div>
	</div>
	<div class="card-footer" style="margin-left:.5rem;">
		<ul>
			<li> 
				<a href="" class="author-name">{{question.user.user_name}}</a>
				<span> <i class="fa fa-clock-o" aria-hidden="true"></i> {{question.date_created}}</span>
			<li > <span>Thích </span> {{question.votes_count}}</li>
			<li ><span>Trả lời </span> {{question.answers_count}}</li>
			<li ><span>Xem</span> {{question.views_count}}</li>
		</ul>
	</div>
		
</div>
@endverbatim