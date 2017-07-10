@extends('layouts.app')
@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1" id="test-result-content">
			<div class="row">
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
					<div id="test-info">
						<p style="font-size: 20px; text-align: center;">{{$test->title}}</p>
						<p style="margin-left:10px;">Số câu hỏi:  <span>{{$test->number_of_questions}}</span></p>
						@if($test->level == 0)
							<p style="margin-left:10px;"> Mức độ: <span > dễ</span> </p>
						@else
							@if($test->level == 2)
								<p style="margin-left:10px;"> Mức độ:<span > trung bình</span> </p>
							@else
								<p style="margin-left:10px;"> Mức độ: <span > khó</span></p>
							@endif
						@endif
						<p style="margin-left:10px;">Thời gian làm bài:  <span>{{$test->total_time}} phút</span></p>
					</div>
					@if($test->test_type == 0)
					<div class="pmd-card pmd-z-depth" id="result-table">
						<div class="table-responsive">
							<table class="table pmd-table">
								<thead>
					                <tr>
					                  <th>Câu hỏi</th>
					                  <th>Kết quả</th>
					                  <th></th>
					                </tr>
								</thead>
								<tbody>
									@foreach($mtestAnswer as $answer)
					                <tr>
					                  <td data-title="Name">{{$answer->mtest->content}}</td>
					                  @if($answer->user_test_choiced == $answer->mtest->incorrect_id)
					                  	 <td data-title=""><i class="fa fa-check"style="color:#007E33"></i></td>
					                  @else
					                   	<td data-title=""><i class="fa fa-times" aria-hidden="true" style="color:#ff4444"></i></td>
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
																<span class="red-text">{{$answer->mtest->correctAnswer->title}}</span>
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
					</div>
					@else
						<div class="">
							<h3 style="border-bottom: solid 2px #2BBBAD; padding: 10px;">Bài bạn làm</h3>
							<div style="padding: 20px; background:#fff;">{!!$userTestAnswer->result_content!!}</div>
							<h3 style="border-bottom: solid 2px #2BBBAD; padding: 10px;">Đáp án/hướng dẫn</h3>
							<div style="padding: 20px; background:#fff;">
							@if($test->writingTest->explan)
							{!!$test->writingTest->explan!!}
							@else
								Bài thi chưa được cập nhật đáp án/ hướng dẫn...!
							@endif
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>	
		<div class="col-md-4 col-md-offset-4" style="margin-top: 20px; margin-bottom: 20px;">
			<a href="{{ url('tests/show/'.$test->id) }}"  class="btn pmd-btn-outline pmd-ripple-effect btn-danger pull-left" type="button"><span class="glyphicon glyphicon-repeat"></span> Làm lại</a>
			<a " class="btn pmd-btn-outline pmd-ripple-effect btn-primary pull-right" type="button"><span class="glyphicon glyphicon-share-alt"></span> Chia sẻ</a>
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
