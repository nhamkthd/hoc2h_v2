@extends('questions.layout')
@section('question-content')
	<div class="row">
		<div class="col-md-3 sidebar">
			<a href="{{route('showQuestionCreateFrom')}}"  class="btn btn-main" style="width: 100%;" >Đăng câu hỏi</a>
			<hr>
			<p class="menu-label">Thống Kê</p>
				<section>
					<ul class="menu-list">
						<li ng-class="{active:tab === 2}"><a href > Mới nhất </a></li>
						<li ng-class="{active:tab === 1}"><a href > Nổi bật</a></li>
						<li ng-class="{active:tab === 3}"><a href >Nổi trong tuần </a> </li>
						<li ng-class="{active:tab === 4}"><a href > Câu hỏi của tôi  </a></li>
						<li ng-class="{active:tab === 5}"><a href > Đang theo dõi </a></li>
						<li ng-class="{active:tab === 4}"><a href > Đã được giải quyết </a></li>
						<li ng-class="{active:tab === 4}"><a href > Chưa được giải quyết </a></li>
						<li ng-class="{active:tab === 4}"><a href > Chưa có câu trả lời </a></li>
						<li ng-class="{active:tab === 4}"><a href> Thành viên tiêu biểu </a></li>
					</ul>
				</section>
			</div>
			<div class="col-md-9 main-content">
				Conten.....
			</div>
		</div>
	</div>
@endsection
