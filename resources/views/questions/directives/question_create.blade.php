@extends('questions.layout')
@section('question_content')
<div class="row box" ng-controller = "CreateQuestionController">
	@verbatim
		{{setSelectedTab(0)}}	
	@endverbatim
	<div ng-init="loadTags()"></div>
	<form name="frmQuestion" novalidate="">
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
					<span class="help-inline"
						  ng-show="frmQuestion.category.$invalid && frmQuestion.category.$touched">Thể  không được để trống!</span>
				</div>
			</div>
		</div>
		<div class="form-group col-md-12">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="md-form">
    				<input placeholder="Tiêu đề" id="title" name="title" type="text" ng-model="title" class="form-control" required>
    				<span class="help-inline validate-text" 
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
		 <tags-input class="form-group" add-from-autocomplete-only="true" ng-model="tagsList" add-on-paste="true" display-property="name" max-tags="4" placeholder="Chèn tags">
      		<auto-complete source="loadTags($query)"></auto-complete>
    	</tags-input>

		<div class="col-md-8 col-md-offset-1" style="margin-top: 50px;">
			<a href="{{route('questions')}}" class="btn btn-warning" type="button" >Huỷ bỏ</a>
			<button class="btn btn-default" type="button" ng-click="submitQuestion()"  >Đăng lên</button>
		</div>
	</form>
</div>
@endsection

