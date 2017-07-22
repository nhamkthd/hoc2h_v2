@verbatim
	<div class="row">
		<div class="col-xs-11 col-md-11">
			<div>
				<a style="color:#0099CC; font-size: 18px;" href="{{'tests/show'}}/{{x.id}}">{{x.title}}</a>
				<div class="mic-info">
					Đăng bởi <a href="#">{{x.user.user_name}}</a> tại <a href="#"><span class="orange-text"> {{x.category.title}} </span></a> {{x.created_at}}
					<span class="pull-right green-text">{{x.user_test.length}} lượt tham gia</span>
				</div>
			</div>
		</div>
	</div>
@endverbatim