@extends('layouts.app')
@section('content')
<script type="text/javascript">
	$(window).bind('beforeunload', function(){
 	 	return 'chưa tạo xong. bạn có muốn thoát?';
});
</script>
<div class="container" ng-app ="hoc2h-test" ng-controller="createTest">
	<div class="row">
		<div class="col-md-12 main-content box">
				<div ng-show="tab === 1" >
					<div class="col-md-10 col-md-offset-1 ">
						<legend class="text-center">Tạo đề thi</legend>
						<div class="row">
							<div class="col-md-12">
								<form novalidate name="form" >
									
									<div class="col-md-10 col-md-offset-1" style="margin-top: 20px;">
										<div class="form-group pmd-textfield pmd-textfield-floating-label">
										<label>Chọn thể loại *</label>
										@verbatim
											<select ng-model="category" name="category" required class="select-with-search form-control pmd-select2"  ng-options="x.title for x in categorys">
												
											</select>
										@endverbatim
										</div>
										<div class="alert alert-danger fade in" ng-show="form.category.$touched && form.category.$invalid">
											<span ng-show="form.category.$error.required">Hãy chọn 1 thể loại.</span>
											
										</div>
									</div>
									
									<div class="col-md-10 col-md-offset-1">
										<div class="form-group pmd-textfield">
											<label for="Small">Tiêu Đề *</label>
											<input type="text" required name="title" ng-minlength="3" ng-maxlength="500" ng-model="title" id="Small" class="form-control" value="" autocomplete="off">
										</div>

										<div class="alert alert-danger fade in" ng-show="form.title.$touched && form.title.$invalid">
											<span ng-show="form.title.$error.required">Tiêu đề không được để trống.</span>
											<span ng-show="form.title.$error.minlength">Tiêu đề quá ngắn .</span>
											<span ng-show="form.title.$error.maxlength">Tiêu đề quá dài.</span>
										</div>
										
									</div>
									
									<div class="col-md-4 col-md-offset-1">
										<div class="form-group pmd-textfield">
											<label for="Small">Số Câu Hỏi *</label>
											<input type="number" name="number_of_questions" required ng-model="number_of_questions" min="1" max="500" class="form-control" value="">
										</div>	
										<div class="alert alert-danger fade in" ng-show="form.number_of_questions.$touched && form.number_of_questions.$invalid">
											<span ng-show="form.number_of_questions.$error.required">Số câu hỏi không được để trống.</span>
											<span ng-show="form.number_of_questions.$error.min">Số câu hỏi phải lớn hơn 0 .</span>
											<span ng-show="form.number_of_questions.$error.max">Số câu hỏi quá nhiều.</span>
										</div>
									</div>
									<div class="col-md-4 col-md-offset-2">
										<div class="form-group pmd-textfield">
											<label for="Small">Tổng Thời Gian (Phút) *</label>
											<input type="number" required ng-model="time" name="time" min="1"  class="form-control" value="">
										</div>
										<div class="alert alert-danger fade in" ng-show="form.time.$touched && form.time.$invalid">
											<span ng-show="form.time.$error.required">Thời gian không được để trống.</span>
											<span ng-show="form.time.$error.min">Thời gian phải lớn hơn 0 .</span>
											
										</div>	
									</div>
									
									<div class="col-md-10 col-md-offset-1" ng-init="test_type=1">
										<div class="form-group pmd-textfield">
											<label style="color:#4B515D; margin-top: 15px; margin-right: 20px;" for="Small">Dạng Đề *</label>
											<label class="radio-inline" style="margin-bottom: 5px;">
												<input type="radio"  ng-checked="true" ng-model="test_type" name="test_type" value="0">
												<span for="inlineRadio1">Trắc Nghiệm</span>
											</label>
											<label class="radio-inline " style="margin-bottom: 5px;">
												<input type="radio" ng-model="test_type" name="test_type" value="1">
												<span for="inlineRadio2">Tự Luận</span>
											</label>
										</div>
									</div>
									
									<div class="col-md-10 col-md-offset-1" ng-init="levels = [
												    {title: 'Dễ', id: 1},
												    {title: 'Trung bình', id: 2},
												    {title: 'Khó', id: 3}]">
										<div class="form-group pmd-textfield pmd-textfield-floating-label">
											<label>Độ Khó *</label>
											<select class="select-simple form-control pmd-select2" ng-model="level" required name="level" ng-options="x.title for x in levels">
												
											</select>
										</div>
										<div class="alert alert-danger fade in" ng-show="form.level.$touched && form.level.$invalid">
											<span ng-show="form.level.$error.required">Hãy chọn độ khó.</span>
											
										</div>
									</div>
									
									<div class="col-md-4 col-md-offset-5" style="margin-top: 20px; margin-bottom: 20px;">
										<button ng-click="submit_test(test_type)" ng-disabled="form.$invalid" type="submit" class="btn btn-outline-primary waves-effect"> Tiếp Tục </button >
										</div>
									</form>
								</div>

							</div>
						</div>



				</div>
				<div ng-show="tab === 2">
					@include('tests.directives.create_writing')
				</div>
				<div ng-show="tab === 3">
					@include('tests.directives.create_multichoice')
				</div>
				<div ng-show="tab === 4">
					
				</div>
				<div ng-show="tab === 5">
					
				</div>
			</div>
	</div>
</div>
@endsection
