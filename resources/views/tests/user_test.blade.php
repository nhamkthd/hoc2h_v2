 {{-- created by tran.nham on 24.05.2017 --}}
@extends('layouts.app')
@section('content')
	<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
	<div class="col-md-10 col-md-offset-1 main-content container app-content ng-scope">
		<div class="row">
			<div class="col-md-12 box">
				<h2 class="info-dark-text">{{$test->title}}</h2>
				<p><strong>Thể loại/Danh mục: </strong><span class="warning-dark-text">{{$test->category->title}}</span></p>
				@if($test->test_type == 0)
					<p><strong>Dạng đề:</strong><span class="warning-dark-text">Trắc nghiệm</span></p>
				@else
					<p><strong>Dạng đề: </strong><span class="warning-dark-text"> Tự luận</span></p>
				@endif
				<p><strong>Thời gian: </strong><span class="warning-dark-text">{{$test->total_time}} phút</span></p>
				@if($test->level == 1)
					<p><strong>Trình độ: </strong><span class="warning-dark-text">Dễ</span></p>
				@else
					@if($test->level == 2)
						<p><strong>Trình độ: </strong><span class="warning-dark-text">Trung bình</span></p>
					@else
						<p><strong>Trình độ: </strong><span class="warning-dark-text">Khó</span></p>
					@endif
				@endif
				<p><strong>Số lần đã làm: </strong><span class="warning-dark-text">{{$test->user_test_count}}</span></p>
			</div>
				@if($is_time_count == 1)
					<div class="text-center" id="time-count" style="position: fixed; bottom:500px; right: 30px; width:100px; height: 40px; border: solid 3px green;background: #ffab91; font-size:20px;">
					</div>
				@endif
				<div class="col-md-12 box" style="margin-top:30px;">
					<h2 style="padding:10px; margin-bottom: 20px; width: 15%; margin-left: 10px; text-decoration: underline;">Đề Thi</h2>
					<form method="post" action="{{url('/tests/usertest/submittestchoice')}}" id="form_testchoice">
					<input type="hidden" name="test_id" value="{{$test->id}}">
					{{csrf_field()}}
					@foreach($test->mtest as $question)
						<div class="row">
							<div class="col-md-12">
								<p style="color:green; font-size: 18px; ">{{$question->content}}</p>
							</div>
							@foreach($question->mTestAnswer as $answer)
								<div class="col-md-12" style="margin-left: 20px;">
									<label class="radio-inline pmd-radio pmd-radio-ripple-effect" style="margin-bottom: 10px;">
										<input type="radio" name="{{$question->id}}" id="inlineRadio1" value="{{$answer->order_id}}">
										<span for="inlineRadio1">{{$answer->title}}</span>
									</label>
								</div>
								<input type="radio" style="display: none" name="{{$question->id}}" id="inlineRadio1" checked value="-1">
							@endforeach
						</div>
						<hr style="border-top:solid 1px #e0e0e0;">
					@endforeach
					</form>
					<button data-target="#submit-dialog" data-toggle="modal" style="margin-bottom: 20px" type="button" class="btn pmd-btn-raised pmd-ripple-effect btn-default"><i class="fa fa-paper-plane" aria-hidden="true"></i> Nộp bài</button>
					<div tabindex="-1" class="modal fade" id="submit-dialog" style="display: none;" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-body">Bạn thật sự muốn nộp bài!</div>
								<div class="pmd-modal-action text-right">
									<button data-dismiss="modal"  class="btn pmd-ripple-effect btn-warning pmd-btn-flat" type="button"> Xem lại</button>
									<button id="submit_testchoice" class="btn pmd-ripple-effect btn-default pmd-btn-flat" type="submit"> Nộp bài</button>
									
								</div>
							</div>
						</div>
					</div>
					<button style="margin-bottom:20px; margin-left: 20px;" type="button" class="btn pmd-btn-raised pmd-ripple-effect btn-warning" data-target="#cancel-dialog" data-toggle="modal"><i class="fa fa-close" aria-hidden="true"></i> Hủy bỏ </button >
				</div>
		</div>		
	</div>
	<script type="text/javascript">

		function startTimer(duration, display) {
		    var timer = duration, minutes, seconds;
		    setInterval(function () {
		        minutes = parseInt(timer / 60, 10)
		        seconds = parseInt(timer % 60, 10);

		        minutes = minutes < 10 ? "0" + minutes : minutes;
		        seconds = seconds < 10 ? "0" + seconds : seconds;

		        display.textContent =minutes + ":" + seconds;

		        if (--timer < 0) {
		           $('#form_testchoice').submit();
		        }
		    }, 1000);
		}

		$(document).ready(function () {
		    var totalMinutes = 60 * {{$test->total_time}},
		        display = document.querySelector('#time-count');

		    	startTimer(totalMinutes, display);

		    	$('#submit_testchoice').click(function(event) {
		    		$('#form_testchoice').submit();
		    	});




		});
		$(window).on('beforeunload', function(){
    		alert('bạn muốn làm lại ');
		});
	</script>
@endsection