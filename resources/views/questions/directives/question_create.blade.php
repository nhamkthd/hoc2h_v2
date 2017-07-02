<div class="row">
	<form name="frmQuestion" novalidate="" > 
		<legend class="text-center">Đăng câu hỏi</legend>
		<div class="form-group col-md-12">
			<div class="row">
				<label class="control-label col-md-10 col-md-offset-1" for="selectbasic">Thể loại</label>
				<div class="col-md-8  col-md-offset-1">
					<select class="form-control" 
					    ng-model="category_id">
					    <option>--</option>
					    <option value="1">Kiến thức THPT</option>
					    <option value="2">Kiến thức THCS</option>
					</select>
				</div>
			</div>
		</div>
		<div class="form-group col-md-12">
			<div class="row">
				<label class="control-label col-md-10 col-md-offset-1" for="selectbasic">Tiêu đề</label>
				<div class="col-md-10  col-md-offset-1">
					<input name="title" type="text" ng-model="title" class="form-control input-md" required >
					<span class="help-inline danger-color" 
	                      ng-show="frmQuestion.title.$invalid && frmQuestion.title.$touched">Tiêu đề không được để trống!</span>

	                @verbatim
	                	{{input3}}
	                @endverbatim
				</div>
			</div>
		</div>
		<div class="form-group col-md-12">
			<div class="row">
				<label class="control-label col-md-10 col-md-offset-1" for="selectbasic">Nội dung</label>
				<div class="col-md-10  col-md-offset-1">
					<textarea id="question_field" ng-model="content" class="form-control"></textarea>
					<script>
						CKEDITOR.replace( 'question_field',{
							filebrowserUploadUrl: "upload/upload.php" 
						});
					</script>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-md-offset-1">
			<button class="btn btn-default" type="button" ng-click="selectTab(2)">Huỷ bỏ</button>
			<button class="btn btn-main" type="button" id="submit" ng-click="createSubmit()" >Đăng lên</button>
		</div>
	</form>
</div>