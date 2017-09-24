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
	a.is-link.cl-orgin:hover{color:#3F729B; }

	@media screen and (min-width: 769px){
		.question-list-item {padding: 0 0 1em;}
	}
	.question-list-item { -webkit-box-pack: justify; 
		-ms-flex-pack: justify; 
		justify-content: space-between; 
		-webkit-box-align: center; 
		-ms-flex-align: center; 
		align-items: center; 
		background-color: #fff;
		color: #818181; 
		margin: 0 0 1em; 
		padding:10px;}
	.content {font-size: 13px; color: #000;}

	p.role-title{font-size:11px;font-weight:500; color:#3F729B;}
	p.role-title.admin{color: #ff4444;}

	.title a{color:#007E33;}
	.title a:hover{text-decoration: underline;}
	@media screen and (min-width: 769px) {
		.question-list-summary.title {float: left;}
	}
	.question-list-summary .meta  {font-size: 10px; font-weight: 600; color:#a7a1a1; }
	.question-list-summary.content{font-size: 12px;}
	.content{line-height: 1.4em;}

	.footer {padding-bottom:0px; float:right; margin-top:0px; height: 30px;} 
	.footer ul {list-style: none; display: flex; flex: row wrap; justify-content: flex-end; padding-left: 0; } 
	.footer li + li {margin-left: .5rem; } 
	.footer li {font-size: .75rem; text-align: center;  position: relative;  color:#3F729B;} 
</style>
@verbatim

 <div class="question-list-item z-depth-2 hoverable">
	<div class="row">
		<div class="col s12">
			<div class="question-list-summary">
				<h5 class="title">
					<a href="/questions/question/{{question.id}}">{{question.title}}</a>
				</h5>
				<div class="meta in-caps mb-1">
					<span>
						Đăng bởi <a href="/users/{{question.user.id}}/profile" class="is-link user-name"> {{question.user.name}}</a>
						 • {{question.date_created}}
						 • <a href="" class="is-link cl-orgin">{{question.category.title}}</a>
						
					</span>
				</div>
				<div class="content">
					<p ng-bind-html="question.content| textShortenerFilter: 220"></p>
				</div>
				<div class="question-tags" ng-hide="question.tags.length == 0" >
					<ul>
						<li ng-repeat="tag in question.tags">
						<a href="/questions/tagged/?id={{tag.id}}">{{tag.name}}</a></li>
					</ul>
				</div>
				<div class="footer">
					<ul>
						<li ng-show="question.is_resolved === 1"><i class="fa fa-check" aria-hidden="true" style="color: #007E33; font-size: 16px;"></i></li>
						<li><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><span> {{question.votes_count}} thích</span> </li>
						<li><i class="fa fa-comments-o" aria-hidden="true"></i><span> {{question.answers_count}} trả lời</span></li>
						<li><i class="fa fa-eye" aria-hidden="true"></i> <span> {{question.views_count}} xem </span></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div> 
@endverbatim