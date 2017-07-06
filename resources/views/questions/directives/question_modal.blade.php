@verbatim
<div class="modal fade" id="edit_question_m" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Sửa câu hỏi</h4>
			</div>
			<div class="modal-body">
				<input placeholder="Tiêu đề" id="title" name="title" type="text" ng-model="title_edit" class="form-control" required>
				<div ckeditor="options" ng-model="edit_question_content" ready="onReady()"></div>
			</div>
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-warning">Huỷ bỏ</button>
				<button data-dismiss="modal" class="btn btn-info" ng-click="editQuestion()">Lưu thay đổi</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="delete_question_m" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center"><i class="fa fa-warning danger-text" aria-hidden="true"></i> Bạn thật sự muốn xoá câu hỏi này!</h4>
			</div>
			<div class="modal-body">
				<p class="danger-dark-text">Lưu ý rằng khi bạn chọn xoá câu hỏi này, tất cả những gì liên quan sẽ đều bị xoá...</p>
			</div>
			<div class="modal-footer">
				<a href="{{route('')}}" data-dismiss="modal" class="btn btn-warning">Vẫn xoá</a>
				<button data-dismiss="modal" class="btn btn-info">Thôi</button>
			</div>
		</div>
	</div>
</div>

@endverbatim