@extends('layouts.app')
@section('content')

<div class="container" ng-app ="hoc2h-test" ng-controller="TestController">
	<div class="row">
		<div class="col-md-3 sidebar">
			<button ng-click="selectTab(1)" class="btn btn-main" style="width: 100%; margin-top:20px;">Tạo Đề</button>
			<hr>
			<p class="menu-label">Thống Kê</>
			<section>
				<ul class="menu-list">
					<li ng-class="{active:tab === 2}"><a href ng-click="selectTab(2)"> Tất Cả Đề Thi</a></li>
					<li ng-class="{active:tab === 3}"><a href ng-click="selectTab(3)"> Đề Thi Nổi Bật</a></li>
					<li ng-class="{active:tab === 4}"><a href ng-click="selectTab(4)"> Đề Thi Bạn Tạo </a></li>
					<li ng-class="{active:tab === 5}"><a href ng-click="selectTab(5)"> Đề Thi Bạn Đã Làm </a></li>
				</ul>
			</section>
		</div>
		<div class="col-md-9 main-content">
				<div ng-show="tab === 1" class="box">
					Tạo đề
				</div>
				<div ng-show="tab === 2">
					tat ca đề
				</div>
				<div ng-show="tab === 3">
					cau hoi noi bat
				</div>
				<div ng-show="tab === 4">
					Đề bạn tạo
				</div>
				<div ng-show="tab === 5">
					Đề bạn đã làm
				</div>
			</div>
	</div>
</div>
@endsection
