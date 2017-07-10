
<style type="text/css">
	.correct{
		color: red;
	}
</style>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Sửa câu hỏi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row" id="document">
					<form action="" method="post">

						<div class="col-md-12">
							<div class="row">

								<div class="col-md-10">
									<div class="form-group pmd-textfield">
										<label for="Small">Câu Hỏi * :</label>
										<textarea class="form-control" required ng-model="editTest.content"> </textarea>
									</div>	


								</div>		
							</div>

							<div class="row">
								<div class="col-md-10">
									<div class="form-group pmd-textfield">
										<label for="Small">Hướng dẫn :</label>
										<textarea class="form-control" required ng-model="editTest.explan"> </textarea>
									</div>	
								</div>
							</div>

							<div id="group_answer">			
								<div class="row" id="answer">
									@verbatim
									<div class="row" ng-repeat="x in editTest.answer">
										<div class="col-md-7 col-md-offset-1" >
											<div class="alert alert-success">
												{{x.title}}
											</div>
										</div>

										<div class="col-md-3" style="margin-top:15px;">
											<div class="checkbox pmd-default-theme">
												<label class="radio-inline pmd-radio pmd-radio-ripple-effect" style="margin-bottom: 5px;">
													<input ng-init="is_correct=0" type="radio" ng-checked="x.is_correct==1" name="is_correct" value="$index" ng-click="choice($index,'edit')">

													<span for="is_correct">đáp án đúng</span>
												</label>
												<a ng-click="removeAnswer($index,'edit')" href="#nothing" style="margin-left: 20px;" ><i class="fa fa-times-circle-o" aria-hidden="true"></i> Xóa </a>
											</div>
										</div>
									</div>
									@endverbatim

								</div>
							</div>
							<div class="row" style="margin-bottom: 50px">
								<div class="col-md-6 col-md-offset-1">
									<div class="form-group pmd-textfield">
										<input ng-enter="addAnswer(answerEdit,'edit')" type="text" ng-init="answerEdit=''" name="answer" ng-model='answerEdit' class="form-control" placeholder="Câu trả lời">
									</div>	
									<div ng-init="error=''" class="alert alert-danger fade in" ng-hide="error==''">
										@verbatim
										<span>{{error}}</span>
										@endverbatim
									</div>
								</div>
								<div class="col-md-4">
									<a class="btn pmd-ripple-effect btn-default" ng-click="addAnswer(answerEdit,'edit')">
										Thêm câu trả lời
									</a>
								</div>

							</div>	

						</div>

					</form>

				</div>
			</div>
			<div class="modal-footer">
				
				<button type="button" class="btn btn-primary" data-dismiss="modal">close</button>
			</div>
		</div>
	</div>
</div>

<div class="col-md-10 col-md-offset-1 main-content">
	<legend class="text-center">Tạo đề trắc nghiệm</legend>
	<div class="col-md-12">
		@verbatim
		<div class="col-md-10 col-md-offset-1">
			<h4><strong>Tiêu đề: </strong>{{test.title}} </h4>
			<h4><strong>Danh mục/Thể loại: </strong>{{test.category_title}} </h4>
			<h4><strong>Dạng đề: </strong>	Trắc nhiệm </h4>
			<h4><strong>Thời Gian: </strong>{{test.time}} phút</h4>
			<h4><strong>Số câu hỏi: </strong>{{test.number_of_questions}} câu</h4>
			<h4><strong>Độ khó: </strong>{{test.level_title}} </h4>
		</div>	
		@endverbatim
		
		<div class="col-md-12" id="doc">
			<div class="col-md-12">
				@verbatim
				<div class="row" ng-repeat="x in mtests">
					<div class="col-md-12">
						<p style="color:green; font-size: 18px;display:inline; ">Câu {{$index + 1}} :{{x.content}} 
							<a href="#" ng-click="editQa($index)"><i class="fa fa-edit" aria-hidden="true"></i> Sửa</a> 
							<a href="#" ng-click="deleteQa($index)"><i class="fa fa-trash" aria-hidden="true"></i> Xoá</a>
						</p>
					</div>
					
					<div class="col-md-12" style="margin-left: 20px;" ng-repeat="y in x.answer">
						<label class="radio-inline pmd-radio pmd-radio-ripple-effect" style="margin-bottom: 10px;">

							<span for="inlineRadio1"  ng-class="{correct:y.is_correct==1}">{{$index + 1}}, {{y.title}}</span>

						</label>
					</div>
					<input type="radio" style="display: none" name="" id="inlineRadio1" checked value="-1">
					
				</div>
				@endverbatim
				<hr style="border-top:solid 1px #e0e0e0;">


				<form id="form" name="Mform">
					<div class="row" id="document">
						<form action="" method="post">
							
							<div class="col-md-12">
								<div class="row">

									<div class="col-md-10">
										<div class="form-group pmd-textfield">
											<label for="Small">Câu Hỏi * :</label>
											<textarea class="form-control" required name="content" ng-model="content"> </textarea>
										</div>	
										

									</div>		
								</div>

								<div class="row">
									<div class="col-md-10">
										<div class="form-group pmd-textfield">
											<label for="Small">Hướng dẫn :</label>
											<textarea class="form-control" ng-init="explan=''" name="explan" ng-model="explan"> </textarea>
										</div>	
									</div>
								</div>

								<div id="group_answer" style="margin-left: 12px;">			
									<div class="row" id="answer">
										@verbatim
										<div class="row" ng-repeat="x in mtestanswers">
											<div class="col-md-7" >
												<div class="alert alert-success">
													{{x.title}}
												</div>
											</div>

											<div class="col-md-3" style="margin-top:15px;">
												<div class="checkbox pmd-default-theme">
													<label class="radio-inline pmd-radio pmd-radio-ripple-effect" style="margin-bottom: 5px;">
														<input ng-init="is_correct=0" type="radio" ng-checked="$index==0" name="is_correct" value="$index" ng-click="choice($index,'add')">

														<span for="is_correct">đáp án đúng</span>
													</label>
													<a ng-click="removeAnswer($index,'add')" href="#nothing" style="margin-left: 20px;" ><i class="fa fa-times-circle-o" aria-hidden="true"></i> Xóa </a>
												</div>
											</div>
										</div>
										@endverbatim

									</div>
								</div>
								<div class="row" style="margin-bottom: 50px">
									<div class="col-md-6 col-md-offset-1">
										<div class="form-group pmd-textfield">
											<input ng-enter="addAnswer(answer,'add')" type="text" ng-init="answer=''" name="answer" ng-model='answer' class="form-control" placeholder="Câu trả lời">
										</div>	
										<div ng-init="error=''" class="alert alert-danger fade in" ng-hide="error==''">
											@verbatim
											<span>{{error}}</span>
											@endverbatim
										</div>
									</div>
									<div class="col-md-4">
										<a class="btn pmd-ripple-effect btn-default" ng-click="addAnswer(answer,'add')">
											<i class="fa fa-plus-square" aria-hidden="true"></i>
										</a>
									</div>

								</div>	

							</div>

						</form>

					</div>

					<div class="col-md-12">
						<button ng-disabled="Mform.$invalid" class="btn pmd-btn-outline pmd-ripple-effect btn-info" ng-click="addQuesTion(content,explan)" >		
							<i class="fa fa-plus" aria-hidden="true"></i> Lưu và Thêm câu hỏi
						</button>

						<button class="btn pmd-btn-outline pmd-ripple-effect btn-primary pull-right" ng-click="finish()">		
							<i class="fa fa-save" aria-hidden="true"></i>	Hoàn Thành
						</button>
					</div>	
				</form>
			</div>
		</div>			
	</div>
</div>