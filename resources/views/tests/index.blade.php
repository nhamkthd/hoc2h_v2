@extends('layouts.app')
@section('content')

<div class="container" ng-app ="hoc2h-test" ng-controller="TestController">
	<div class="row">
		@include('tests/sidebar')
		<div class="col-md-9">
		
			<div class="panel panel-default widget">
				<div class="panel-heading">
					<i class="fa fa-list" aria-hidden="true"></i>
					<h3 class="panel-title"> Tất Cả Đề Thi</h3>
					<span class="label label-info">{{$Test->count()}}</span>
				</div>
				@foreach ($Test->sortByDesc('id') as $test)
				<div class="panel-body">
			
					<div class="row">
						<div class="col-xs-1 col-md-1">
							<img class="img-avt" src="{{asset('img/test_icon.png')}}"  alt="avatar" width="40" height="40">
						</div>
						<div class="col-xs-11 col-md-11">
							<div>
								<a style="color:#0099CC; font-size: 18px;" href="{{url('tests/show')}}/{{$test->id}}">{{$test->title}}</a>
								<div class="mic-info">
									Đăng bởi <a href="#">{{$test->user->user_name}}</a> tại <a href="#"><span class="orange-text"> {{$test->category->title}} </span></a> {{$test->created_at->diffForHumans()}}
									<span class="pull-right green-text">2 lượt tham gia</span>
								</div>
							</div>

						</div>
					</div>
				
				</div>
				@endforeach
			</div>

		</div>
	</div>
</div>
@endsection