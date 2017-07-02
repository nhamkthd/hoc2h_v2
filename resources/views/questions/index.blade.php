@extends('layouts.app')
@section('content')

<div class="container" ng-app="hoc2h-question" ng-controller="QuestionController">
	<div class="row">
		<div class="col-md-3 sidebar">
			<button ng-click="selectTab(1)" class="btn btn-main" style="width: 100%; margin-top:20px;">Đăng câu hỏi</button>
			<hr>
			<p class="menu-label">Thống Kê</>
				<section>
					<ul class="menu-list">
						<li ng-class="{active:tab === 2}"><a href ng-click="selectTab(2)"> Tất Cả Câu Hỏi </a></li>
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
					<ul class="list-group">
						@include('questions.directives.list_item')
						@include('questions.directives.list_item')
						@include('questions.directives.list_item')
						@include('questions.directives.list_item')
						@include('questions.directives.list_item')
						@include('questions.directives.list_item')
						@include('questions.directives.list_item')
					</ul>
				</div>
				<div ng-show="tab === 3">
					<ul class="list-group">
						@include('questions.directives.list_item')
						@include('questions.directives.list_item')
						@include('questions.directives.list_item')
						@include('questions.directives.list_item')
					</ul>
				</div>
				<div ng-show="tab === 4">
					<ul class="list-group">
						@include('questions.directives.list_item')
						@include('questions.directives.list_item')
						@include('questions.directives.list_item')
						
					</ul>
				</div>
				<div ng-show="tab === 5">

					@include('questions.directives.question_detail')
				</div>
			</div>
		</div>
	</div>
	@endsection
