@verbatim
	<div class="row">
		<div class="col-xs-1 col-md-1">
			<img src="{{test.user.avatar}}" class="img-responsive">
		</div>
		<div class="col-xs-11 col-md-11">
			<div>
				<a class="title-hyperlink" href="{{'tests/show'}}/{{test.id}}">{{test.title}}</a>
				<div class="mic-info">
					Đăng bởi <a style="color: #2bbbad;">{{test.user.name}}</a> tại <a href="#"><span class="orange-text"> {{test.category.title}} </span></a> <span class="date-created"><i class="fa fa-clock-o" aria-hidden="true"></i> {{test.date_created}}</span>
					<span class="pull-right green-text">{{test.user_test.length}} lượt tham gia</span>
				</div>
				
			</div>
		</div>
	</div>
@endverbatim