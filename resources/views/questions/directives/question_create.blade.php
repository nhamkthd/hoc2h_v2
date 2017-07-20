@extends('questions.layout')
@section('question_content')
<div class="row box" style="margin-bottom: 50px;" ng-controller = "CreateQuestionController">
	@verbatim
		{{setSelectedTab(0)}}	
	@endverbatim
	<div ng-init="loadTags()"></div>
	<div ng-init="getCategories()"></div>
	<form name="frmQuestion" novalidate="">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<legend class="text-center">Đăng câu hỏi</legend>
		<div class="form-group col-md-12">
			<div class="row">
				<div class="col-md-4  col-md-offset-1">
					<select selector
							multi="false"
							model="category_id"
							name="category"
							options="categories"
							value-attr="id"
							label-attr="title"
							placeholder="Chọn một chuyên mục" name="category"></select>
					<span class="help-inline danger-text" 
						  ng-show="!category_id && frmQuestion.category.$touched">Chuyên mục không được để trống!</span>
				</div>
			</div>
		</div>
		<div class="form-group col-md-12">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="md-form">
    				<input placeholder="Tiêu đề" id="title" name="title" type="text" ng-model="title" class="form-control" required>
    				<span class="help-inline danger-text" 
	                      ng-show="frmQuestion.title.$invalid && frmQuestion.title.$touched">Tiêu đề không được để trống!</span>
					</div>
					
				</div>
			</div>
		</div>
		<div class="form-group col-md-12">
			<div class="row">
				<label class="control-label col-md-10 col-md-offset-1" for="selectbasic">Nội dung</label>
				<div class="col-md-10  col-md-offset-1">
					<div ckeditor="options" ng-model="content" ready="onReady()"></div>
				</div>
			</div>
		</div>
		<!--tags input-->
		 <div class="form-group col-md-12">
			<div class="row">
				<div class="col-md-10  col-md-offset-1">
					<select selector
							multi="true"
							model="tagsList"
							options="tags"
							value-attr="id"
							label-attr="name"
							placeholder="Chèn tags"></select>
				</div>
			</div>
		</div>

		<div class="col-md-4 col-md-offset-4">
			<a style="width:40%;" href="{{url('/questions')}}" class="btn btn-warning" type="button" >Huỷ bỏ</a>
			<button style="width: 40%;" class="btn btn-default" type="button" ng-click="submitQuestion()"  >Đăng lên</button>
		</div>
	</form>
</div>
@endsection

