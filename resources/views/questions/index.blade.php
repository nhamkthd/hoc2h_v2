@extends('layouts.app')
@section('content')
<style type="text/css">
	table{border:solid 1px green;}
	table >tr >td,th {padding: 10px;}
</style>
<div class="container" ng-app="hoc2h-quuestion" ng-controller="QuestionController">
	<div class="row">
		<div class="col-md-3 sidebar">
			<button ng-click="selectTab(1)" class="btn btn-main" style="width: 100%; margin-top:20px;">Tạo câu hỏi</button>
			<hr>
			<p class="menu-label">Thống Kê</>
				<section>
					<ul class="menu-list">
						<li ng-class="{active:tab === 2}"><a href ng-click="selectTab(2)"> Tất Cả Câu Hỏi</a></li>
						<li ng-class="{active:tab === 3}"><a href ng-click="selectTab(3)"> Câu Hỏi Nổi Bật</a></li>
						<li ng-class="{active:tab === 4}"><a href ng-click="selectTab(4)"> Câu Hỏi Của Tôi </a></li>
					</ul>
				</section>
			</div>
			<div class="col-md-9 main-content">
				<div ng-show="tab === 1" class="box">
					@include('questions.directives.question_create')
				</div>
				<div ng-show="tab === 2">
					tat ca cau hoi
				</div>
				<div ng-show="tab === 3">
					cau hoi noi bat
				</div>
				<div ng-show="tab === 4">
					Cau hoi cua toi
				</div>
				<div ng-show="tab === 5">
	
				</div>
			</div>
		</div>
	</div>
	@endsection
