<div class="col-md-3 sidebar">
	<a href="{{url('tests/create')}}"><button class="btn btn-main" style="width: 100%; margin-top:20px;">Tạo Đề</button></a>
	<hr>
	<p class="menu-label">Thống Kê</>
		<section>
			<ul class="menu-list">
				<li><a href="{{ url('tests/') }}"> Tất Cả Đề Thi</a></li>
				<li><a href=""> Đề Thi Nổi Bật</a></li>
				<li><a href="{{ url('tests/UserCreate') }}"> Đề Thi Bạn Tạo </a></li>
				<li><a href=""> Đề Thi Bạn Đã Làm </a></li>
			</ul>
		</section>
	</div>

	<script type="text/javascript">
		var url = window.location.href;
		$('.menu-list li').each(function(index) {

			if($(this).find('a').attr('href')==url){
				$(this).addClass('active');
			}
		});
	</script>