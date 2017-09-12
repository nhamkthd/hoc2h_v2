
<style type="text/css">
	.correct{color: red;}
	.test-info h3 {font-size: 17px; font-weight: 600px; color: #0099CC; text-transform: uppercase; text-align: center;margin-bottom: 20px;}
	.test-info h5 > span{color: #FF8800; margin-left: 3px;}
	.questions-list {margin-top: 30px; padding: 0;}
	.test-question {margin:10px 0;}
	.test-question p {color:#4285F4; font-size: 16px;display:inline; }
	.test-question a {font-size: 13px; color:#3E4551;}
</style>
<div class="modal fade" id="deleteQa" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Xác nhận</h4>
			</div>
			<div class="modal-body">
				<p>Bạn có chắc muốn xóa câu hỏi này???</p>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" ng-click="deleteQa(index)">Vẫn Xóa</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Thôi</button>
			</div>
		</div>

	</div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Sửa câu hỏi</h3>
			</div>
			<div class="modal-body">
				<div class="row" id="document">
					<form action="" method="post">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-10">
									<div class="form-group pmd-textfield">
										<label for="Small">Câu Hỏi * :</label>
										<div ckeditor="ckEditorOption" required ng-model="editTest.content"></div>
									</div>	
								</div>		
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group pmd-textfield">
										<label for="Small">Hướng dẫn :</label>
										<div ckeditor="ckEditorOption" required ng-model="editTest.explan"></div>
									</div>	
								</div>
							</div>
							<div id="group_answer">			
								<div class="row" id="answer">
									@verbatim
									<div class="row" ng-repeat="x in editTest.m_test_answer">
										<div class="col-md-7 col-md-offset-1" >
											<input type="" class="form-control" value="{{x.title}}" ng-model='x.title' name="">
										</div>

										<div class="col-md-3" style="margin-top:15px;">
											<div class="checkbox pmd-default-theme">
												<label class="radio-inline pmd-radio pmd-radio-ripple-effect" style="margin-bottom: 5px;">
													<input ng-init="is_correct=0" type="radio" ng-checked="x.is_correct==1" name="is_correct" value="$index" ng-click="choice($index,'edit')">

													<span for="is_correct">đáp án đúng</span>
												</label>
												<a ng-click="removeAnswer($index,'edit')" href="#nothing" style="margin-left: 20px; color: #ff4444; font-size: 13px;" ><i class="fa fa-times-circle-o" aria-hidden="true"></i> Xóa </a>
											</div>
										</div>
									</div>
									@endverbatim

								</div>
							</div>
							<div class="row" style="margin-bottom: 50px">
								<div class="col-md-6 col-md-offset-1" style="margin-top: 5px; padding-left: 0;">
									<div class="form-group pmd-textfield">
										<input ng-enter="addAnswer(answerEdit,'edit')" type="text" ng-init="answerEdit=''" name="answer" ng-model='answerEdit' class="form-control" placeholder="Đáp án lựa chọn">
									</div>	
									<div ng-init="error=''" class="alert alert-danger fade in" ng-hide="error==''">
										@verbatim
										<span>{{error}}</span>
										@endverbatim
									</div>
								</div>
								<div class="col-md-1">
									<a class="btn pmd-ripple-effect btn-default" ng-click="addAnswer(answerEdit,'edit')">
										<i class="fa fa-plus-square" aria-hidden="true"></i></a>
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
	<legend class="text-center">Sửa đề trắc nghiệm</legend>
	<div class="col-md-12">
		@verbatim
		<div class="col-md-12 box test-info">
			<h3>Tiêu đề: <span>{{test.title}}</span> </h3>
			<h5>Danh mục/Thể loại:<span>{{test.category_title}}</span></h5>
			<h5>Dạng đề:<span>Trắc nhiệm</span></h5>
			<h5>Thời Gian:<span>{{test.time}} phút</span></h5>
			<h5>Số câu hỏi: <span>{{test.number_of_questions}} câu</span></h5>
			<h5>Độ khó:<span>{{level.title}}</span></h5>
		</div>	
		@endverbatim
		
		<div class="col-md-12 questions-list" id="doc">
			<div class="col-md-12" ng-init="getMtests({{$id}})">
				@verbatim
				<div class="row" ng-repeat="x in mtests">
					<div class="col-md-12 test-question">
						<strong>Câu {{$index + 1}}</strong> : <p ng-bind-html="convertHtml(x.content)">{{x.content}}</p>
						<a ng-click="editQa($index)"><i class="fa fa-edit" aria-hidden="true"></i>Sửa</a> 
						<a ng-click="deleteShow($index)"><i class="fa fa-trash" aria-hidden="true"></i>Xoá</a>
					</div>

						<div class="col-md-12" ng-repeat="y in x.m_test_answer">
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
												<div ckeditor="ckEditorOption" equired name="content" ng-model="content"></div>
											</div>	
										</div>		
									</div>

									<div class="row">
										<div class="col-md-10">
											<div class="form-group pmd-textfield">
												<label for="Small">Hướng dẫn :</label>
												<div ckeditor="ckEditorOption" ng-init="explan=''" name="explan" ng-model="explan"></div>
											</div>	
										</div>
									</div>

									<div id="group_answer" style="margin-left: 12px;">			
										<div class="row" id="answer">
											@verbatim
											<div ng-repeat="x in mtestanswers">
												<div class="col-md-7" >
													<input type="" class="form-control" value="{{x.title}}" ng-model='x.title' name="">
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
										<div class="col-md-6" style="margin-top: 5px;">
											<div class="form-group pmd-textfield">
											<input ng-enter="addAnswer(answer,'add')" type="text" ng-init="answer=''" name="answer" ng-model='answer' class="form-control" placeholder="Đáp án lựa chọn">
											</div>	
											<div ng-init="error=''" class="alert alert-danger fade in" ng-hide="error==''">
												@verbatim
												<span>{{error}}</span>
												@endverbatim
											</div>
										</div>
										<div class="col-md-1">
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