
@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/rate.css')}}">
<style type="text/css">
	.test-info h3 {font-size: 17px; font-weight: 600px; color: #0099CC; text-transform: uppercase; text-align: center;margin-bottom: 20px;}
	.test-info a{font-size: 13px; float: right; margin-bottom: 10px; margin-left: 10px; color: #4B515D;}
	.test-info h5 > span{color: #FF8800; margin-left: 3px;}
</style>
<div class="container app-content ng-scope" ng-app ="hoc2h-test" ng-controller="ShowTestController">
	@if($id_comment)
		<div class="row" ng-init="initTest({{$test->id}},{{Auth::user()}},{{$id_comment}})">
	@else
		<div class="row" ng-init="initTest({{$test->id}},{{Auth::user()}})">
	@endif
<div class="col-md-8 main-content ">
		<div class="box test-info">
			<h3>{{$test->title}}</h3>
			<h5>Thể loại/Danh mục: <span>{{$test->category->title}}</span></h5>
			<h5>Dạng đề:<span>Trắc nghiệm</span></h5>
			<h5>Số câu hỏi:<span>{{$test->number_of_questions}} câu</span></h5>
			<h5>Thời gian: <span>{{$test->total_time}} phút</span></h5>
			@if($test->level == 1)
				<h5>Độ khó: <span>Dễ</span></h5>
			@else
				@if($test->level == 2)
					<h5>Độ khó: <span>Trung bình</span></h5>
				@else
					<h5>Độ khó: <span>Khó</span></h5>
				@endif
			@endif
			<h5>Số người đã làm: <span>{{$test->user_test->count()}}</span></h5>
			@if ($test->user->id==Auth::user()->id)
				<a href="#">
					<i class="fa fa-trash-o" aria-hidden="true"></i> Xoá đề</a>
				<a href="{{ url('tests/edit') }}/{{$test->id}}">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa đề</a>
			@endif
		</div>

		<div class="row">
			<div class=" col-md-4 col-md-offset-4">
			<button style="margin-top: 20px; width: 100%;" data-target="#list-test-options-dialog" data-toggle="modal" type="button" class="btn btn-success"><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> Vào làm bài </button>
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

			<div class="comments-list"> 
				<div tabindex="-1" class="modal fade" id="rate-dialog" style="display: none;" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header pmd-modal-bordered"> 
									<h3>Đánh giá đề thi này</h3>
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
			<button data-target="#rate-dialog" 
					data-toggle="modal" 
					type="button" 
					class="btn btn-outline-success waves-effect">
				 	Đánh giá
			</button>
			<div class="col-md-12 answer-list" ng-init='initComment({{$test->id}})'>
				<div class="col-md-12 commet-box">
					<textarea  class="form-control" ng-init="cmt=''" name="cmt" ng-model='cmt' placeholder="Viết bình luận"></textarea>
					<button class="btn btn-primary pull-right" type="button" ng-click="addComment()">Gửi trả bình </button>
				</div>
				<div class="row">
					<div class="col-md-12" ng-repeat="cmt in comment">
						@include('tests.directives.list_cmt')
					</div>
					<div ng-show='pageComment!=maxPage' class="col-md-12 " style="padding-bottom: 10px">
						<button ng-click='extendComment()' class=" btn btn-primary">Tải thêm bình luận</button>
					</div>
				</div>

			</div>
			
			</div>
			@include('tests.sidebar')
	</div>

</div>

@endsection