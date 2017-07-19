@extends('layouts.app')
@section('content')

<div class="container" ng-app ="hoc2h-test" ng-controller="TestController">
	<div class="row">
		<div class="col-md-9">
		
			<div class="panel panel-default widget">
				<div class="panel-heading">
					<span class="glyphicon glyphicon-th-list"></span>
					<h3 class="panel-title"> Tất Cả Đề Thi</h3>
					<span class="label label-info">{{$Test->count()}}</span>
				</div>
				<div class="panel-body">
					@foreach ($Test->sortByDesc('id') as $test)
					<div class="row">
						<div class="col-xs-2 col-md-2">
							<img class="img-avt" src="http://localhost/duanweb/laravel/public//images/users/1498055029.jpg" alt="avatar" width="100">
						</div>
						<div class="col-xs-10 col-md-10">
							<div>
								<a class="list-titel" href={{ url('tests/usercreatetest') }}/{{$test->id}}>{{$test->title}}</a>
								<div class="mic-info">
									Đăng bởi <a href="#">{{$test->user->name}}</a> tại <a href="#"><span class="orange-text"> {{$test->category->title}} </span></a> {{$test->created_at->diffForHumans()}}
									<span class="pull-right green-text">2 lượt tham gia</span>
								</div>
							</div>

						</div>
					</div>
					<hr>
					@endforeach
				</div>
			</div>
		</div>
		@include('tests/sidebar')
	</div>
</div>
@endsection