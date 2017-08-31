<style type="text/css">

	.in-caps {text-transform: uppercase;}
	.mb-1 {margin-bottom: 1em!important;}
	.is-circle {border-radius: 50%;}
	.is-circle.is-outlined{border:solid 2px #fff;}
	.bg-white {background-color: #fff;}
	a.is-link{color: #00b1b3;}
	a.is-link:hover{color: #4d545d;}
	a.is-link.user-name{font-size: 12px;}
	a.is-link.cl-orgin{color:#FF8800; }

	@media screen and (min-width: 769px){
		.question-list-item {padding: 0 0 1em;}
	}
	.question-list-item { -webkit-box-pack: justify; -ms-flex-pack: justify; justify-content: space-between; -webkit-box-align: center; -ms-flex-align: center; align-items: center; color: #818181; margin: 0 0 1em; border-bottom: 1px solid #f1f0f0; padding-bottom: 0px;}
	.question-list-avatar{ vertical-align:baseline; margin-top:8px; height:75px;text-align: center;}
	.question-list-avatar img{width: 45px; height: 45px;}

	p.role-title{font-size:11px;font-weight:500; color:#3F729B;}
	p.role-title.admin{color: #ff4444;}

	.title a{color: #4d545d;}
	.title a:hover{text-decoration: underline;}
	@media screen and (min-width: 769px) {
		.question-list-summary.title {float: left;}
	}
	.question-list-summary .meta  {font-size: 10px; font-weight: 600; color:#a7a1a1; }
	.question-list-summary.content{font-size: 12px;}
	.content{line-height: 1.4em;}

	.footer {padding-bottom:0px; float:right; margin-top:-10px; } 
	.footer ul {list-style: none; display: flex; flex: row wrap; justify-content: flex-end; padding-left: 0; } 
	.footer li:first-child {margin-right: auto; } 
	.footer li + li {margin-left: .5rem; } 
	.footer li {font-size: .75rem; height: 1.5rem;line-height: 1.5rem; text-align: center;  position: relative;  color:#9e9e9e;} 
	.footer li >span {font-weight: 500;}
</style>
@verbatim
<div class="question-list-item">
	<div class="row">
		<div class="col-md-2 col-sm-2">
			<div class="question-list-avatar">
				<div>
					<a href="/users/{{question.user.id}}/profile">
						<img src="{{question.user.avatar}}" class="is-circle is-outlined bg-white">
					</a>
				</div>
				<a href="/users/{{question.user.id}}/profile" class="is-link user-name"> {{question.user.name}}</a>
				<p ng-class="{admin:question.user.role_id == 2}" class="role-title">{{question.user.role.title}}</p>
			</div>
		</div>
		<div class="col-md-10 col-sm-10" style="padding-left:5px;">
			<div class="question-list-summary">
				<h4 class="title">
					<a href="/questions/question/{{question.id}}">{{question.title}}
						<span ng-show="question.is_resolved == 1">
							<i class="fa fa-check-circle success-dark-text" aria-hidden="true"></i></span>
						<span ng-show="question.is_resolved == 0">
							<i class="fa fa-question-circle danger-dark-text" aria-hidden="true"></i></span>
					</a>
				</h4>
				<div class="meta in-caps mb-1">
					<span>
						<a href="" class="is-link cl-orgin">{{question.category.title}}</a>
						<i class="fa fa-clock-o" aria-hidden="true"></i> {{question.date_created}}
					</span>
				</div>
				<div class="content">
					<p style="font-size: 13px;" ng-bind-html="question.content| textShortenerFilter: 220"></p>
				</div>
				<div class="question-tags" ng-hide="question.tags.length == 0" >
					<ul>
						<li ng-repeat="tag in question.tags">
						<a href="/questions/tagged/?id={{tag.id}}">{{tag.name}}</a></li>
					</ul>
				</div>
				<div class="footer">
					<ul>
						<li><i class="fa fa-bar-chart" aria-hidden="true"></i></li>
						<li><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><span> {{question.votes_count}}</span> </li>
						<li><i class="fa fa-comments-o" aria-hidden="true"></i><span> {{question.answers_count}}</span></li>
						<li><i class="fa fa-eye" aria-hidden="true"></i> <span> {{question.views_count}}</span></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endverbatim