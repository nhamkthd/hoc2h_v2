@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/rate.css')}}">
<div class="container app-content ng-scope" ng-app ="hoc2h-test" ng-controller="ShowTestController">
	@if($id_comment)
		<div class="row" ng-init="initTest({{$test->id}},{{Auth::user()}},{{$id_comment}})">
	@else
		<div class="row" ng-init="initTest({{$test->id}},{{Auth::user()}})">
	@endif
<div class="col-md-8 main-content ">
		<div class="box">
			<h3 class="info-dark-text">{{$test->title}}</h3>
			<p><strong>Thể loại/Danh mục: </strong>{{$test->category->title}}</p>
			@if($test->test_type == 0)
				<p><strong>Dạng đề:</strong>Trắc nghiệm</p>
			@else
				<p><strong>Dạng đề: </strong>Tự luận</p>
			@endif
			<p><strong>Thời gian: </strong>{{$test->total_time}} phút</p>
			@if($test->level == 1)
				<p><strong>Độ khó: </strong>Dễ</p>
			@else
				@if($test->level == 2)
					<p><strong>Độ khó: </strong>Trung bình</p>
				@else
					<p><strong>Độ khó: </strong>Khó</p>
				@endif
			@endif
			<p><strong>Số người đã làm: {{$test->user_test->count()}}</strong></p>
		</div>

		<div class="row">
			<div class=" col-md-4 col-md-offset-4">
			<button style="margin-top: 20px; width: 100%;" data-target="#list-test-options-dialog" data-toggle="modal" type="button" class="btn btn-primary"><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> Vào làm bài </button>
			</div>

				<form method="POST" action="{{ url('tests/usertest') }}" id="submit_edit" novalidate="novalidate">
					{{csrf_field()}}
					<input type="hidden" name="test_id" value="{{$test->id}}">


					<div tabindex="-1" class="modal fade" id="list-test-options-dialog" style="display: none;" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header pmd-modal-bordered"> 
									<h3 class="pmd-card-title-text">Chọn cách thức thi</h3>
								</div>
								<div class="modal-body">
									<div class="radio">
										<label class="pmd-radio">
											<input type="radio" name="is_time_count" checked="" value="1"><span class="pmd-radio-label">&nbsp;</span>
											<span for="time_count">Tính thời gian</span> 
										</label>
									</div>
									<div class="radio">
										<label class="pmd-radio">
											<input type="radio" name="is_time_count" value="0"><span class="pmd-radio-label">&nbsp;</span>
											<span for="not_time_count">Không tính thời gian</span> 
										</label>
									</div>
								</div>
								<div class="pmd-modal-action pmd-modal-bordered text-right">
									<button data-dismiss="modal" class="btn pmd-ripple-effect btn-warning pmd-btn-flat" type="button">Lúc khác</button>
									<button class="btn pmd-ripple-effect btn-default pmd-btn-flat" type="submit">Vào thi</button>
									
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>

			<div class="comments-list" style="width: 100%;"> 
			
				<div tabindex="-1" class="modal fade" id="rate-dialog" style="display: none;" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header pmd-modal-bordered"> 
									<h3 class="pmd-card-title-text">Đánh giá bài thi</h3>
								</div>
								<div class="modal-body">
									<div class="acidjs-rating-stars">
										<form id="form_rate">
        									<input type="radio" name="rate" ng-model='rate' ng-checked="user_rate==5" id="group-1-0" value="5"><label for="group-1-0"></label>
        									<input type="radio" name="rate" ng-model='rate'  ng-checked="user_rate==4" id="group-1-1" value="4"><label for="group-1-1"></label>
        									<input type="radio" name="rate" ng-model='rate'  ng-checked="user_rate==3" id="group-1-2" value="3"><label for="group-1-2"></label>
        									<input type="radio" name="rate" ng-model='rate'  ng-checked="user_rate==2" id="group-1-3" value="2"><label for="group-1-3"></label>
        									<input type="radio" name="rate" ng-model='rate' ng-checked="user_rate==1" id="group-1-4" value="1"><label for="group-1-4"></label>
										</form>
									</div>
								</div>
								<div class="pmd-modal-action pmd-modal-bordered text-right">

									<button data-dismiss="modal" class="btn pmd-ripple-effect btn-warning pmd-btn-flat" type="button">Lúc khác</button>

									<button ng-click="addRate()" class="btn pmd-ripple-effect btn-default pmd-btn-flat" type="submit">Đánh giá</button>

									
								</div>
							</div>
						</div>
					</div>


				<div class="acidjs-rating-stars acidjs-rating-disabled">
					<form id="rate">
        				<input type="radio" name="group-1" ng-checked="avg_rate==5" id="group-1-0" value="5" ><label for="group-1-0"></label><!--
        				--><input type="radio" name="group-1" ng-checked="avg_rate==4" id="group-1-1" value="4"><label for="group-1-1"></label><!--
       					 --><input type="radio" name="group-1" ng-checked="avg_rate==3" id="group-1-2" value="3"><label for="group-1-2"></label><!--
        				--><input type="radio" name="group-1" ng-checked="avg_rate==2" id="group-1-3" value="2"><label for="group-1-3"></label><!--
    					--><input type="radio" name="group-1" ng-checked="avg_rate==1" id="group-1-4" value="1"><label for="group-1-4"></label>
					</form>
				</div>
			</div>
			<button data-target="#rate-dialog" data-toggle="modal" type="button" class="btn btn-dark-green">
				<i class="fa fa-star" aria-hidden="true"></i> Đánh giá đề thi
			</button>
			<div class="col-md-12 answer-list">
				<div class="row">
					<div class="col-md-12" ng-repeat="cmt in test.comment">
							@include('tests.directives.list_cmt')
						
					</div>
					<div class="col-md-12 commet-box">
						<textarea style="padding:10px 0 0 10px;" ng-init="cmt=''" name="cmt" ng-model='cmt' placeholder="Viết bình luận"></textarea>
					</div>
					<button class="btn btn-outline-default waves-effect pull-right" style="margin-top:20px; margin-right: 10px;" type="button" ng-click="addComment()">Gửi trả lời</button>
				</div>

			</div>
			
			</div>
			@include('tests.sidebar')
	</div>

</div>

@endsection