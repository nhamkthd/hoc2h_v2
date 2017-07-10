 {{-- created by tran.nham on 24.05.2017 --}}
@extends('layouts.app')
@section('content')
	<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
	<div class="col-md-10 col-md-offset-1 main-content">
		<div class="row">
			<div class="col-md-12 " style="border:dotted 1px #007E33; padding: 20px;background: #fafafa;">
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
					<p><strong>Trình độ: </strong>Dễ</p>
				@else
					@if($test->level == 2)
						<p><strong>Trình độ: </strong>Trung bình</p>
					@else
						<p><strong>Trình độ: </strong>Khó</p>
					@endif
				@endif
				<p><strong>Số lần đã làm: </strong>{{$test->user_test_count}}</p>
			</div>
			@if($test->test_type == 1)
				<div class="col-md-12" style="background: #fff; border:solid 2px green; margin-top: 20px; padding: 40px;">
					<h2 style=" background: #00C851; padding: 10px 0px 10px 10px; width: 8%;"><strong>Đề bài</strong></h2>
					@if($test->writingTest->is_document)
						<iframe src="http://docs.google.com/gview?url={{env('APP_URL')}}/{{$test->writingTest->content}}&embedded=true"  frameborder="0" class="col-md-12" height="500px"></iframe>
					@else
						<p>{!!$test->writingTest->content!!}</p>
					@endif
				</div>
				<div id="test_content" class="col-md-12" style="background:#fff; margin-bottom: 50px;">
				@if($is_time_count == 1)
					<div class="text-center" id="time-count" style="position: fixed; bottom:500px; right: 50px; width:100px; height: 40px; border: solid 3px green;background: #ffab91; font-size:20px;">
					</div>
				@endif
				<h2 style=" background: #00C851; padding: 10px 0px 10px 10px; width: 14%;"><strong>Soạn đáp án</strong></h2>
				<form method="POST" action="{{url('/tests/usertest/submit')}}">
					{{csrf_field()}}
					<input type="hidden" name="test_id" value="{{$test->id}}">
					<div class="form-group pmd-textfield" id="qt">
					    <label id="question-error"  style="display: none" class="error" for="Small"></label>
					  	<textarea class="form-control" name="user_test_answer" id="user_test_answer"></textarea>
					  	<script>
	    					CKEDITOR.replace('user_test_answer');
						</script>
					</div>
					<button data-target="#submit-dialog" data-toggle="modal" style="margin-bottom: 20px" type="button" class="btn pmd-btn-raised pmd-ripple-effect btn-success"><span class="glyphicon glyphicon-send"></span> Nộp bài</button>
					<div tabindex="-1" class="modal fade" id="submit-dialog" style="display: none;" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-body">Bạn thật sự muốn nộp bài!</div>
								<div class="pmd-modal-action text-right">
									<button class="btn pmd-ripple-effect btn-primary pmd-btn-flat" type="submit"><span class="glyphicon glyphicon-send"></span> Nộp bài</button>
									<button data-dismiss="modal"  class="btn pmd-ripple-effect btn-default pmd-btn-flat" type="button"><span class="glyphicon glyphicon-pencil"></span> Xem lại</button>
								</div>
							</div>
						</div>
					</div>
					
					<button style="margin-bottom:20px; margin-left: 20px;" type="button" class="btn pmd-btn-raised pmd-ripple-effect btn-warning" data-target="#cancel-dialog" data-toggle="modal"><span class="glyphicon glyphicon-remove-circle"></span> Hủy bỏ </button >


					<div tabindex="-1" class="modal fade" id="cancel-dialog"  aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-body">Bạn muốn huỷ bỏ kết quả này?</div>
								<div class="pmd-modal-action text-right">
									<button data-dismiss="modal"  class="btn pmd-ripple-effect btn-primary pmd-btn-flat" type="button">OK</button>
									<button data-dismiss="modal"  class="btn pmd-ripple-effect btn-default pmd-btn-flat" type="button">Thôi</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			@else
				@if($is_time_count == 1)
					<div class="text-center" id="time-count" style="position: fixed; bottom:500px; right: 30px; width:100px; height: 40px; border: solid 3px green;background: #ffab91; font-size:20px;">
					</div>
				@endif
				<div class="col-md-12" style="background: #fff; border: solid 2px green; margin:20px 0px; padding-left: 30px;">
					<h2 style="padding:10px; margin-bottom: 20px; background: #00C851; width: 15%;">Đề Thi</h2>
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
										<input type="radio" name="{{$question->id}}" id="inlineRadio1" value="{{$answer->id}}">
										<span for="inlineRadio1">{{$answer->title}}</span>
									</label>
								</div>
								<input type="radio" style="display: none" name="{{$question->id}}" id="inlineRadio1" checked value="-1">
							@endforeach
						</div>
						<hr style="border-top:solid 1px #e0e0e0;">

					@endforeach
					</form>
					<button data-target="#submit-dialog" data-toggle="modal" style="margin-bottom: 20px" type="button" class="btn pmd-btn-raised pmd-ripple-effect btn-success"><span class="glyphicon glyphicon-send"></span> Nộp bài</button>
					<div tabindex="-1" class="modal fade" id="submit-dialog" style="display: none;" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-body">Bạn thật sự muốn nộp bài!</div>
								<div class="pmd-modal-action text-right">
									<button id="submit_testchoice" class="btn pmd-ripple-effect btn-primary pmd-btn-flat" type="submit"><span class="glyphicon glyphicon-send"></span> Nộp bài</button>
									<button data-dismiss="modal"  class="btn pmd-ripple-effect btn-default pmd-btn-flat" type="button"><span class="glyphicon glyphicon-pencil"></span> Xem lại</button>
								</div>
							</div>
						</div>
					</div>
					<button style="margin-bottom:20px; margin-left: 20px;" type="button" class="btn pmd-btn-raised pmd-ripple-effect btn-warning" data-target="#cancel-dialog" data-toggle="modal"><span class="glyphicon glyphicon-remove-circle"></span> Hủy bỏ </button >
				</div>
			@endif
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