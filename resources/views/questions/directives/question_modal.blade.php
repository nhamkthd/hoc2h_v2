@verbatim
<script type="text/ng-template" id="editQuestionModal.html">
	<div class="modal-header">
		<h3 class="modal-title" id="modal-title"><i class="fa fa-edit" aria-hidden="true"></i> Sửa câu hỏi</h3>
	</div>
	<div class="modal-body" id="modal-body">
		<input placeholder="Tiêu đề" id="title" name="title" type="text" ng-model="title_edit" class="form-control" required>
		<div ckeditor="options" ng-model="edit_question_content" ready="onReady()"></div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-warning" type="button" ng-click="cancel()">Huỷ bỏ</button>
		<button class="btn btn-primary" type="button" ng-click="submit()">Lưu lại</button>
	</div>
</script>

<script type="text/ng-template" id="deleteQuestionModal.html">
	<div class="modal-header">
		<h3 class="modal-title text-center" id="modal-title"><i class="fa fa-warning danger-dark-text" aria-hidden="true"></i> Bạn thật sự muốn câu hỏi này...!</h3>
	</div>
	<div class="modal-body" id="modal-body">
		<p class="danger-dark-text">Lưu ý rằng khi xoá câu hỏi các câu trả lời và bình luận liên quan cũng sẽ bị xoá.</p>
	</div>
	<div class="modal-footer">
		
		@endverbatim
			<form method="POST" action="{{url('questions/delete')}}">
		@verbatim
				<input  name="question_id" type="hidden" value="question.id">
				<button class="btn btn-warning" type="button" ng-click="cancel()">Huỷ bỏ</button>
				<button class="btn btn-primary" type="submit" ng-click="submit()">Vẫn xoá</button>
			</form>
		
	</div>
</script>
<script type="text/ng-template" id="editQuestionCategoryModal.html">
	<div class="modal-header">
		<h3 class="modal-title text-center" id="modal-title"><i class="fa fa-edit" aria-hidden="true"></i> Thay đổi chuyên mục</h3>
	</div>
	<div class="modal-body" id="modal-body">
		<div class="row">
				<div class="col-md-10  col-md-offset-1">
					<select selector
							multi="false"
							model="category_edit"
							name="category"
							options="categories"
							value-attr="id"
							label-attr="title"
							placeholder="Chọn một chuyên mục" name="category"></select>
					<span class="help-inline danger-text" 
						  ng-show="!category_edit && frmQuestion.category.$touched">Chuyên mục không được để trống!</span>
				</div>
			</div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-warning" type="button" ng-click="cancel()">Huỷ bỏ</button>
		<button class="btn btn-primary" type="submit" ng-click="submit()">Lưu lại</button>
	</div>
</script>

<script type="text/ng-template" id="requestModal.html">
	<div class="modal-header">
		<h3 class="modal-title text-center" id="modal-title"><i class="fa fa-edit" aria-hidden="true"></i> Thay đổi chuyên mục</h3>
	</div>
	<div class="modal-body" id="modal-body">
		<div class="row">
				<div class="col-md-10  col-md-offset-1">
					
					<select selector
							multi="false"
							model="category_edit"
							name="category"
							options="categories"
							value-attr="id"
							label-attr="title"
							placeholder="Chọn một chuyên mục" name="category"></select>
					<span class="help-inline danger-text" 
						  ng-show="!category_edit && frmQuestion.category.$touched">Chuyên mục không được để trống!</span>
				</div>
			</div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-warning" type="button" ng-click="cancel()">Huỷ bỏ</button>
		<button class="btn btn-primary" type="submit" ng-click="submit()">Lưu lại</button>
	</div>
</script>
@endverbatim