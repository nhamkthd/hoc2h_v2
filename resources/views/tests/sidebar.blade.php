<div class="col-md-4">
	<div class ="row sidebar">
		<div class="col-md-10 col-md-offset-1">
			<a href="{{url('tests/create')}}"  class="btn btn-outline-default waves-effect" style="width: 100%;" >Tạo Đề</a>
			<hr>
		</div>
		<div class="col-md-10 col-md-offset-1">
			<input placeholder="Tìm kiếm" type="text" ng-model="keywords" ng-change="search()" class="form-control" required>
		</div>
		<hr>
		<p class="menu-label">Thống Kê</p>
		<div class = "col-md-10 col-md-offset-1">
		<section>
			<ul class="menu-list">
				<li ng-class="{active:tab === null}"><a href="{{ url('tests') }}"><i class="fa fa-globe" aria-hidden="true"></i> Tất Cả Đề Thi</a></li>
				<li><a href=""> <i class="fa fa-flag" aria-hidden="true"></i> Đề Thi Nổi Bật</a></li>
				<li ng-class="{active:tab === 'usercreate'}"><a href="{{ url('tests') }}?filter=usercreate"><i class="fa fa-list-alt" aria-hidden="true"></i> Đề Thi Bạn Tạo </a></li>
				<li><a href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Đề Thi Bạn Đã Làm </a></li>
			</ul>
		</section>
		</div>
	</div>
</div>