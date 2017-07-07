@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/rate.css')}}">
<div class="container" ng-app ="hoc2h-test" ng-controller="ShowTestController">
<div class="row">
@include('tests/sidebar')
<div class="col-md-9 main-content">
		<div class="test-info">
			<h1 style="color:green;">{{$test->title}}</h1>
			<hr style=" border-bottom: solid 1px #007E33;">
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
			<p><strong>Số người đã làm: </strong></p>
		</div>
		<div class="row">
			<button style="margin-top: 20px;" data-target="#list-test-options-dialog" data-toggle="modal" type="button" class="btn btn-primary col-md-2 col-md-offset-5"><span class="glyphicon glyphicon-triangle-right"></span> Vào làm bài </button>
				<form method="POST" action="http://localhost/duanweb/laravel/public/tests/usertest" id="submit_edit" novalidate="novalidate">
					<input type="hidden" name="_token" value="EHKYlpNkr4E24QXPadGZDJbwMio91o7dyEKUAymm">
					<input type="hidden" name="test_id" value="3">
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
									<button class="btn pmd-ripple-effect btn-primary pmd-btn-flat" type="submit">Vào thi</button>
									<button data-dismiss="modal" class="btn pmd-ripple-effect btn-default pmd-btn-flat" type="button">Lúc khác</button>
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
											<input type="hidden" name="test_id" value="3">
        									<input type="radio" name="rate" id="group-1-0" value="5" checked="checked"><label for="group-1-0"></label>
        									<input type="radio" name="rate" id="group-1-1" value="4"><label for="group-1-1"></label>
        									<input type="radio" name="rate" id="group-1-2" value="3"><label for="group-1-2"></label>
        									<input type="radio" name="rate" id="group-1-3" value="2"><label for="group-1-3"></label>
        									<input type="radio" checked="" name="rate" id="group-1-4" value="1"><label for="group-1-4"></label>
										</form>
									</div>
								</div>
								<div class="pmd-modal-action pmd-modal-bordered text-right">
									<button id="submit_rate" class="btn pmd-ripple-effect btn-primary pmd-btn-flat" type="submit">Đánh giá</button>

									<button data-dismiss="modal" class="btn pmd-ripple-effect btn-default pmd-btn-flat" type="button">Lúc khác</button>
								</div>
							</div>
						</div>
					</div>
				

				
				<div tabindex="-1" class="modal fade" id="edit-comment-dialog" style="display: none;" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-body">
								<p>Sửa câu trả lời</p>
								<textarea id="edit_comment_field" name="content" required="" class="form-control"></textarea>

							</div>
							<div class="pmd-modal-action pmd-modal-bordered text-right">
								<button class="btn pmd-btn-flat pmd-ripple-effect btn-primary" id="submit-edit-comment" type="button">Lưu lại</button>
								<button data-dismiss="modal" type="button" class="btn pmd-btn-flat pmd-ripple-effect btn-default">Huỷ</button>
							</div>
						</div>
					</div>
				</div>

				
				<div tabindex="-1" class="modal fade" id="comment-delete-dialog" style="display: none;" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h2 class="pmd-card-title-text"><i class="material-icons md-dark pmd-md" style="color: red;">warning</i><span style="margin-bottom: 30px;"> Bạn thất sự muốn xoá câu trả lời này!</span></h2>
							</div>
							<div class="modal-body">
								<p style="color:red;"> Lưu ý rằng khi bạn xoá câu trả lời, các câu trả lời và bình luận liên quan cũng sẽ bị xoá.</p>
							</div>	
							<div class="pmd-modal-action pmd-modal-bordered text-right">

								<input type="hidden" name="question_id" value="3">
								<button id="submit-delete-comment" class="btn pmd-btn-flat pmd-ripple-effect btn-primary" type="submit">Vẫn xoá</button>

								<button data-dismiss="modal" type="button" class="btn pmd-btn-flat pmd-ripple-effect btn-default">Thôi</button>

							</div>
						</div>
					</div>
				</div>
				
				<div tabindex="-1" class="modal fade" id="edit-answer-comment-dialog" style="display: none;" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-body">
								<p>Sửa câu trả lời</p>
								<textarea id="edit_answer_comment_field" name="content" required="" class="form-control"></textarea>

							</div>
							<div class="pmd-modal-action pmd-modal-bordered text-right">
								<button class="btn pmd-btn-flat pmd-ripple-effect btn-primary" id="submit-edit-answer-comment" type="button">Lưu lại</button>
								<button data-dismiss="modal" type="button" class="btn pmd-btn-flat pmd-ripple-effect btn-default">Huỷ</button>
							</div>
						</div>
					</div>
				</div>

				
				<div tabindex="-1" class="modal fade" id="answer-comment-delete-dialog" style="display: none;" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h2 class="pmd-card-title-text"><i class="material-icons md-dark pmd-md" style="color: red;">warning</i><span style="margin-bottom: 30px;"> Bạn thất sự muốn xoá câu trả lời này!</span></h2>
							</div>
							<div class="modal-body">
								<p style="color:red;"> Lưu ý rằng khi bạn xoá câu trả lời, các câu trả lời và bình luận liên quan cũng sẽ bị xoá.</p>
							</div>	
							<div class="pmd-modal-action pmd-modal-bordered text-right">

							<input type="hidden" name="question_id" value="3">
								<button id="submit-delete-answer-comment" class="btn pmd-btn-flat pmd-ripple-effect btn-primary" type="submit">Vẫn xoá</button>

								<button data-dismiss="modal" type="button" class="btn pmd-btn-flat pmd-ripple-effect btn-default">Thôi</button>

							</div>
						</div>
					</div>
				</div>

				<div class="acidjs-rating-stars acidjs-rating-disabled">
					<form id="rate">
        				<input type="radio" name="group-1" id="group-1-0" value="5" ><label for="group-1-0"></label><!--
        				--><input type="radio" name="group-1" id="group-1-1" value="4"><label for="group-1-1"></label><!--
       					 --><input type="radio" name="group-1" id="group-1-2" value="3"><label for="group-1-2"></label><!--
        				--><input type="radio" name="group-1" id="group-1-3" value="2"><label for="group-1-3"></label><!--
    					--><input type="radio" name="group-1" id="group-1-4" value="1"><label for="group-1-4"></label>
					</form>
				</div>
			</div>

			<button type="button" data-target="#rate-dialog" data-toggle="modal" class="btn pmd-btn-raised pmd-ripple-effect btn-info" style="margin:20px 0 10px 10px;">Đánh giá</button>

			</div>
		</div>
		</div>
		@endsection