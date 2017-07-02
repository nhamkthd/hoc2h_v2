@extends('questions.layout')
@section('question_content')
<div class="row box">
	@verbatim
	{{selectTab(0)}}
	@endverbatim
	<form name="frmQuestion" novalidate="" method="post" action="{{route('storeQuestion')}}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<legend class="text-center">Đăng câu hỏi</legend>
		<div class="form-group col-md-12">
			<div class="row">
				<label class="control-label col-md-10 col-md-offset-1" for="selectbasic">Thể loại</label>
				<div class="col-md-4  col-md-offset-1">
					<select class="form-control" 
					    ng-model="category_id" name="category" ng-model="category" required>
					    <option value="1">Kiến thức THPT</option>
					    <option value="2">Kiến thức THCS</option>
					</select>
					<span class="help-inline danger-color"
							ng-show="frmQuestion.category.$invalid && frmQuestion.category.$touched">Thể  không được để trống!</span>
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
				</div>
			</div>
		</div>
		<div class="form-group col-md-12">
			<div class="row">
				<label class="control-label col-md-10 col-md-offset-1" for="selectbasic">Nội dung</label>
				<div class="col-md-10  col-md-offset-1">
					<textarea id="question_field" name="q_content" class="form-control"></textarea>
					<script>
						CKEDITOR.replace( 'question_field',{
							filebrowserUploadUrl: "upload/upload.php" 
						});
					</script>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-md-offset-1" style="margin-top: 20px;">
			<a href="{{route('questions')}}" class="btn btn-default" type="button" >Huỷ bỏ</a>
			<button class="btn btn-main" type="submit" id="submit"  >Đăng lên</button>
		</div>
	</form>
</div>
@endsection
