@verbatim
<div class="card-list">
	<div class="card-header">
		<div class="author">
			<img class="author-avt" src="" width="30" height="30">
			<a href="" class="author-name">{{question.user.user_name}}</a>
			<span ng-show="question.is_resolved == 1"><i class="fa fa-check-circle success-dark-text" aria-hidden="true"></i></span>
			<span ng-show="question.is_resolved == 0"><i class="fa fa-question-circle danger-dark-text" aria-hidden="true"></i></span>
		</div>
	</div>
	<div class="card-body">
		<div class="card-title">
			<a href="questions/question/{{question.id}}">{{question.title}}</a>
		</div>
		<div class="card-summary">
		<p ng-bind-html="question.content| textShortenerFilter: 260"></p>
		<p>{{abc}}</p>
		</div>
		<div class="card-tags">
			<ul>
				<li ng-repeat="tag in questionTags[question.id]"><a href="#">{{tag.name}}</a></li>
			</ul>
		</div>
	</div>
	<div class="card-footer">
		<ul>
			<li ng-bind="question.created_at|date:'dd/MM/yyyy'">{{question.created_at}}</li>
			<li ><i class="fa fa-comments-o" aria-hidden="true"></i> {{question.answers.length}}</li>
			<li ><i class="fa fa-heart" aria-hidden="true"></i> {{question.votes.length}}</li>
			<li ><i class="fa fa-eye" aria-hidden="true"></i> 3</li>
		</ul>
	</div>
</div>
@endverbatim