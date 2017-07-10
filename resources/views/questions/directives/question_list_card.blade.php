<style type="text/css">
	.card-list {padding:10px 0px 0px 0px; border-bottom: 1px solid #757575 ; margin-bottom: 20px;}
	.author {display: block-inline;}
	.author-avt {border-radius:50%; float: left; margin-right:10px;}
	a.author-name {font-size:16px; font-weight: 600;color: #0d47a1; margin-top:10px;}
	.author span {float: right;}

	.card-body {margin-top: 20px;}
	.card-title a {font-size:18px; color:#0099CC;}
	.card-title a:hover {color:#4285F4;text-decoration: underline;}
	.card-tags ul {display: flex; flex-direction: row; flex-wrap: wrap; list-style: none; padding-left: 0; } 
	.card-tags li + li { margin-left: .5rem;}
	.card-tags a {border: 1px solid #4B515D; border-radius: 3px; color: #4d545d; font-size:9px; height: 1.5rem; line-height: 1.5rem; letter-spacing: 1px; padding: 0 .5rem; text-align: center; text-transform: uppercase; white-space: nowrap; width: 5rem; padding:5px; }
	.card-tags a:hover{border:solid 1px #e64a19; color: #e64a19;}

	.card-footer { margin: 0 auto; padding-bottom:5px; } 
	.card-footer ul {list-style: none; display: flex; flex: row wrap; justify-content: flex-end; padding-left: 0; } 
	.card-footer li:first-child {margin-right: auto; } 
	.card-footer li + li {margin-left: .5rem; } 
	.card-footer li {font-size: .75rem; height: 1.5rem; letter-spacing: 1px; line-height: 1.5rem; text-align: center;  position: relative; white-space: nowrap; color:#FF8800;} 
</style>
@verbatim
<div class="card-list">
	<div class="card-header">
		<div class="author">
			<img class="author-avt" src="" width="30" height="30">
			<a href="" class="author-name">{{question.user.user_name}}</a>
			<span ng-show="question.is_resolved == 1"><i class="fa fa-check-circle success-text" aria-hidden="true"></i></span>
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
				<li><a href="#">Toán 12</a></li>
				<li><a href="#">Kiến thức THPT</a></li>
				<li><a href="#">Luyện thi toán</a></li>
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