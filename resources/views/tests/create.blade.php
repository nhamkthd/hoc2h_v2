@extends('layouts.app')
@section('content')
<script type="text/javascript">
	$(window).bind('beforeunload', function(){
 	 return 'chưa tạo xong. bạn có muốn thoát?';
});
</script>
<div class="container" ng-app ="hoc2h-test" ng-controller="createTest">
	<div class="row">
		<div class="col-md-12 main-content">
				<div ng-show="tab === 1" >
					<div class="col-md-10 col-md-offset-1 main-content">
						<h1 class="text-center" style="color:green;">Soạn Đề Thi</h1>
						<hr style="border: solid 1px #9e9e9e;">
						<div class="row">
							<div class="col-md-12" style="background:white; border: solid 1px #e0e0e0 ; margin-bottom: 100px;">
								<form novalidate name="form" >
									

									<div class="col-md-10 col-md-offset-1" style="margin-top: 20px;">
										<div class="form-group pmd-textfield pmd-textfield-floating-label">
										<label>Chọn thể loại *</label>
										@verbatim
											<select ng-model="category" name="category" required class="select-with-search form-control pmd-select2"  ng-options="x.title for x in categorys">
												
											</select>
										@endverbatim
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
											<input type="number" required ng-model="number_of_questions" min="1" class="form-control" value="">
										</div>	
									</div>
									<div class="col-md-4 col-md-offset-2">
										<div class="form-group pmd-textfield">
											<label for="Small">Tổng Thời Gian (Phút) *</label>
											<input type="number" required ng-model="time" min="1"  class="form-control" value="">
										</div>	
									</div>
									
									<div class="col-md-10 col-md-offset-1" ng-init="test_type=1">
										<div class="form-group pmd-textfield">
											<label style="color:#4B515D; margin-top: 15px; margin-right: 20px;" for="Small">Dạng Đề *</label>
											<label class="radio-inline pmd-radio pmd-radio-ripple-effect" style="margin-bottom: 5px;">
												<input type="radio" ng-model="test_type" name="test_type" value="0">
												<span for="inlineRadio1">Trắc Nghiệm</span>
											</label>
											<label class="radio-inline pmd-radio pmd-radio-ripple-effect" style="margin-bottom: 5px;">
												<input type="radio" ng-checked="true" ng-model="test_type" name="test_type" value="1">
												<span for="inlineRadio2">Tự Luận</span>
											</label>
										</div>
									</div>
									
									<div class="col-md-10 col-md-offset-1">
										<div class="form-group pmd-textfield pmd-textfield-floating-label">
											<label>Độ Khó *</label>
											<select class="select-simple form-control pmd-select2" ng-model="level">
												<option value="1">Dễ</option>
												<option value="2">Trung Bình</option>
												<option value="3">Khó</option>
											</select>
										</div>
									</div>
									
									<div class="col-md-4 col-md-offset-5" style="margin-top: 20px; margin-bottom: 20px;">
										<button ng-click="submit_test(test_type)" type="submit" class="btn pmd-ripple-effect btn-primary"> Tiếp Tục </button >
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
					
				</div>
				<div ng-show="tab === 4">
					
				</div>
				<div ng-show="tab === 5">
					
				</div>
			</div>
	</div>
</div>
@endsection
