@verbatim
	<div class="row">
		<div class="col-xs-12 col-md-12">
			<div>
				<a class="title-link" href="{{'tests/show'}}/{{test.id}}">{{test.title}}</a>
				<div class="mic-info">
					Đăng bởi <a href="#">{{test.user.user_name}}</a> tại <a href="#"><span class="orange-text"> {{test.category.title}} </span></a> <span class="date-created"><i class="fa fa-clock-o" aria-hidden="true"></i> {{test.date_created}}</span>
					<span class="pull-right green-text">{{test.user_test.length}} lượt tham gia</span>
				</div>
				
			</div>
		</div>
	</div>
@endverbatim