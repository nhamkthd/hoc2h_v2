@extends('layouts.app')
@section('content')
<div class="row ">
	<div class="col-md-8 col-md-offset-2 app-content">
		<div class="row" style="padding:10px;">
			<div class="col-md-12 text-center">
				<p style="color: #00695c; font-size:25px">Chúc mừng bạn đã hoàn thành bài thi...!</p>
				@if($test->test_type == 0)
				<p style="font-size: 18px;">Bạn đã làm đúng <span class="red-text"> {{$countIsCorrect}}/{{$test->number_of_questions}}</span>  câu, số điểm tạm tính là 
					@php
					$point = number_format($countIsCorrect/$test->number_of_questions*10,1);
					echo "<span class='red-text'>$point</span>";
					@endphp
					điểm.
				</p>
				@endif
			</div>

			<div class="col-md-4 col-md-offset-4" style="padding-bottom: 20px;">
				<button id="show-detail-btn" style="width: 100%;" type="button" class="btn pmd-ripple-effect btn-info"> Xem chi tiết kết quả </button >
			</div>
				<div class="col-md-12" id="result-detail">
					<div class ="box">
						<h3 class="info-dark-text">{{$test->title}}</h3>
						<p >Số câu hỏi:  <span>{{$test->number_of_questions}}</span></p>
						@if($test->level == 0)
						<p > Mức độ: <span > dễ</span> </p>
						@else
						@if($test->level == 2)
						<p > Mức độ:<span > trung bình</span> </p>
						@else
						<p > Mức độ: <span > khó</span></p>
						@endif
						@endif
						<p>Thời gian làm bài:  <span>{{$test->total_time}} phút</span></p>
					</div>
					@if($test->test_type == 0)
					<div style="border:solid 1px #0099CC; margin-top:30px; margin-left: 10px; border-radius: 2px;">
						<table class="table pmd-table">
							<thead>
								<tr>
									<th>Câu hỏi</th>
									<th>Kết quả</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($mtestAnswers as $answer)
								<tr>
									<td class="color-unique" style="width:88%" data-title="Name">{{$answer->mtest->content}}</td>
									@if($answer->user_test_choiced == $answer->mtest->incorrect_id)
										<td class="text-center" data-title=""><i class="fa fa-check color-success"></i></td>
									@else
										<td class="text-center" data-title=""><i class="fa fa-times color-danger" aria-hidden="true"></i></td>
									@endif
									<td>
										<a id="showexplan" data-answer_id={{$answer->id}} href="#nothing">
											<i class="fa fa-ellipsis-h" aria-hidden="true"></i>
										</a>
										<div class="" >
											<tr id="explan_{{$answer->id}}" class="explan-table" style="display: none">
												<td colspan="10" style="border:none;"><table class="table pmd-table table-sm">
													<thead>
														<tr>
															<th style="border:none;" colspan="5">Đáp án và hướng dẫn</th>
														</tr>
													</thead>
													<tbody >
														<tr ">
															<td style="border:none;" data-title="Firm Name">
																Đáp án đúng:
																<span class="red-text">{{App\MTest::correctAnswer($answer->mtest->id)->title}}</span>
															</td>
														</tr>
														<tr>
															<td style="border:none;" data-title="Firm Name">Hướng dẫn:
																{{$answer->mtest->explan}}
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@endif
			</div>
		</div>
	</div>	
	<div class="col-md-4 col-md-offset-4" style="margin-top: 20px; margin-bottom: 20px;">
		<a href="{{ url('tests/show/'.$test->id) }}"  class="btn btn-primary pull-left" type="button"><i class="fa fa-repeat" aria-hidden="true"></i> Làm lại</a>
		<a " class="btn btn-default pull-right" type="button"><i class="fa fa-share" aria-hidden="true"></i> Chia sẻ</a>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip()
		$('#show-detail-btn').on('click',function(event){
			$('#result-detail').slideToggle('nomarl');
		})

		$('body').on('click', '#showexplan', function(event) {

			$(this).parent().parent().parent().find('#explan_'+$(this).data('answer_id')).toggle('slow');

		});
	});
</script>
@endsection
