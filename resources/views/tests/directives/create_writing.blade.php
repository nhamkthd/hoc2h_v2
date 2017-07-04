<div class="col-md-10 col-md-offset-1 main-content">
	
		<div class="test-info">
			<h1 class="text-center" style="color:green;">Soạn Đề Thi</h1>
			<hr style="border: solid 1px #9e9e9e;">
			<div class="col-md-12 box">
				@verbatim
					<div class="col-md-10">
						<h4><strong>Tiêu đề: </strong>{{test.title}} </h4>
						<h4><strong>Danh mục/Thể loại: </strong>{{test.category_title}} </h4>
						<h4><strong>Dạng đề: </strong>	Tự luận</h4>
						<h4><strong>Thời Gian: </strong>{{test.time}} phút</h4>
						<h4><strong>Số câu hỏi: </strong>{{test.number_of_questions}} câu</h4>
						<h4><strong>Độ khó: </strong>{{test.level_title}} </h4>
					</div>	
				@endverbatim
				<div class="col-md-2">
					<a class="btn pmd-ripple-effect btn-success pull-right"> Sửa </a >
				</div>
			</div>

		<form method="POST" id="form_test2" action="{{ route('create_write_test') }}" class="box" enctype="multipart/form-data">
			<div class="row">
				{{csrf_field()}}
				<!--test content-->
				
				<h3 class="col-md-10" style="margin-left: 20px;">Đề bài</h3> 
				@verbatim
					<a class="col-md-6 col-md-offset-3 btn pmd-ripple-effect btn-info" ng-click="click_upload_qa(type_qa)">
						{{type_qa}}
					 </a>		
				@endverbatim
				<div class="col-md-6 col-md-offset-3" id="documents" ng-init="upload_qa=0" ng-show="upload_qa===1">
					<div class="form-group pmd-textfield">
						<label for="Small">Tải đề lên</label>
						<input type="file" accept=".docx,.doc,.pdf" id="document" ng-model="document" required name="document" >
						<label id="documents-error" style="display: none" class="error" for="Small"></label>
					</div>	
				</div>
				<div class="col-md-12 " ng-init="write_qa=1" ng-show="write_qa===1">
					<div class="form-group pmd-textfield" id="qt">
					<label id="question-error"  style="display: none" class="error" for="Small"></label>
					<textarea class="form-control" name="content" ng-model="content"></textarea>
					<script>
						CKEDITOR.replace('content');
					</script>
				</div>
				</div>
				<!--answer/explan-->
				<h3 class="col-md-10" style="margin-left: 20px;">Đáp án/Hướng dẫn giải</h3>
				@verbatim
					<a ng-init="type=upload" class="col-md-6 col-md-offset-3 btn pmd-ripple-effect btn-info" ng-click="click_upload(type)">
						{{type}}
					 </a>
					
					
				@endverbatim
				<div class="col-md-6 col-md-offset-3" id="documents_answer" >
					<div class="form-group pmd-textfield">
						<label for="Small">Tải đáp án lên</label>
						<input type="file" accept=".docx,.doc,.pdf" id="document_answer" required name="document_answer" >
						<label id="documents_answer-error" style="display: none" class="error" for="Small"></label>
					</div>	
				</div>
				<div class="col-md-12">
					<div class="form-group pmd-textfield" id="as">
						<label id="answer-error" style="display: none" class="error" for="Small"></label>
						<textarea class="form-control" id="answer" name="answer"></textarea>

					</div>
					<script>
						CKEDITOR.replace('answer');
					</script>
				</div>
				<div class="col-md-4 col-md-offset-4" style="margin-top: 20px; margin-bottom: 50px;">
					<a href="cancel" style="margin-left: 10px;" type="button"  class="btn pmd-ripple-effect btn-danger"> Huỷ </a>

					<button type="submit" ng-click="submit_wTest()" class="btn pmd-ripple-effect btn-success"> Đăng </button >
				</div>
			</div>
		</form>		
	</div>
</div>

