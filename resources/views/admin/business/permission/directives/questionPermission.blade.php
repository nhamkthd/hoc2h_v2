<div class="container" style="margin-top: 50px">
	<div class="row show-grid">
		<div class="col-md-6">
			<div class="col-md-6">
			<label>Xem câu hỏi:</label>
			</div>
			<div class="col-md-6">
				<input name="view_question" value="0" type="hidden" class="form-control">
				<input value="1" name="view_question" @if ($permission->view_question)
					checked
				@endif type="checkbox" class="form-control" data-toggle="toggle">
			</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Xem câu Trả lời:</label>
			</div>
			<div class="col-md-6">
				{{-- <input value="1" name="view_answer" type="checkbox" class="form-control" @if ($permission->view_answer)
					checked
				@endif data-toggle="toggle"> --}}
			</div>
		</div>
	</div>

	<div class="row show-grid">
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Bình luận câu trả lời:</label>
			</div>
			<div class="col-md-6">
				<input name="comment_answer" value="0" type="hidden" class="form-control">
				<input value="1" type="checkbox" name="comment_answer" class="form-control" @if ($permission->comment_answer)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Trả lời câu hỏi:</label>
			</div>
			<div class="col-md-6">
				<input name="answer_question" value="0" type="hidden" class="form-control">
				<input value="1" name="answer_question" type="checkbox" class="form-control" @if ($permission->answer_question)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
	</div>


	<div class="row show-grid">
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Thích câu hỏi:</label>
			</div>
			<div class="col-md-6">
				<input name="like_question" value="0" type="hidden" class="form-control">
				<input value="1" name="like_question" type="checkbox" class="form-control" @if ($permission->like_question)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Thích câu trả lời:</label>
			</div>
			<div class="col-md-6">
				<input name="like_answer" value="0" type="hidden" class="form-control">
				<input value="1" type="checkbox" class="form-control" name="like_answer" @if ($permission->like_answer)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
	</div>

	<div class="row show-grid">
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Sửa câu hỏi của chính mình:</label>
			</div>
			<div class="col-md-6">
				<input name="edit_qa_by_self" value="0" type="hidden" class="form-control">
				<input value="1" type="checkbox" name="edit_qa_by_self" class="form-control" @if ($permission->edit_qa_by_self)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Sửa tất cả câu hỏi của mọi người:</label>
			</div>
			<div class="col-md-6">
				<input name="edit_qa_by_everyone" value="0" type="hidden" class="form-control">
				<input value="1" type="checkbox" name="edit_qa_by_everyone"  class="form-control" @if ($permission->edit_qa_by_everyone)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
	</div>


	<div class="row show-grid">
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Xóa câu hỏi của chính mình:</label>
			</div>
			<div class="col-md-6">
				<input name="delete_qa_by_self" value="0" type="hidden" class="form-control">
				<input value="1" type="checkbox" name="delete_qa_by_self" class="form-control" @if ($permission->delete_qa_by_self)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Xóa Tất cả câu hỏi của mọi người:</label>
			</div>
			<div class="col-md-6">
				<input name="delete_qa_by_everyone" value="0" type="hidden" class="form-control">
				<input value="1" type="checkbox" name="delete_qa_by_everyone" class="form-control" @if ($permission->delete_qa_by_everyone)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
	</div>


	<div class="row show-grid">
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Sửa trạng thái câu hỏi của chính mình:</label>
			</div>
			<div class="col-md-6">
				<input name="update_question_status_by_self" value="0" type="hidden" class="form-control">
				<input value="1" type="checkbox" name="update_question_status_by_self" class="form-control" @if ($permission->update_question_status_by_self)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Sửa trạng thái của tất cả mọi người:</label>
			</div>
			<div class="col-md-6">
				<input name="update_question_status_by_everyone" value="0" type="hidden" class="form-control">
				<input value="1" type="checkbox" name="update_question_status_by_everyone" class="form-control" @if ($permission->update_question_status_by_everyone)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
	</div>

	<div class="row show-grid">
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Đánh giá làm câu hỏi hay:</label>
			</div>
			<div class="col-md-6">
				<input name="set_best_answer" value="0" type="hidden" class="form-control">
				<input value="1" type="checkbox" name="set_best_answer" class="form-control" @if ($permission->set_best_answer)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Ghim câu hỏi lên đầu trang:</label>
			</div>
			<div class="col-md-6">
				<input name="stick_question" value="0" type="hidden" class="form-control">
				<input value="1" type="checkbox" name="stick_question" class="form-control" @if ($permission->stick_question)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
	</div>

		<div class="row show-grid">
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Báo cáo sai phạm câu hỏi:</label>
			</div>
			<div class="col-md-6">
				<input name="report_question" value="0" type="hidden" class="form-control">
				<input value="1" type="checkbox" name="report_question" class="form-control" @if ($permission->report_question)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Báo cáo sai phạm câu trả lời:</label>
			</div>
			<div class="col-md-6">
				<input name="report_answer" value="0" type="hidden" class="form-control">
				<input value="1" type="checkbox" name="report_answer" class="form-control" @if ($permission->report_answer)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
	</div>
	<div class="row show-grid">
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Kiểm tra báo cáo sai phạm câu hỏi:</label>
			</div>
			<div class="col-md-6">
				<input name="check_qa_report" value="0" type="hidden" class="form-control">
				<input value="1" type="checkbox" name="check_qa_report" class="form-control" @if ($permission->check_qa_report)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Cho phép đính kèm file vào câu hỏi:</label>
			</div>
			<div class="col-md-6">
				<input name="qa_attachments" value="0" type="hidden" class="form-control">
				<input value="1" type="checkbox" name="qa_attachments" class="form-control" @if ($permission->qa_attachments)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
	</div>
	<div class="row show-grid">
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Thích bình luận câu trả lời:</label>
			</div>
			<div class="col-md-6">
				<input name="like_comment" value="0" type="hidden" class="form-control">
				<input value="1" type="checkbox" name="like_comment" class="form-control" @if ($permission->like_comment)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
		<div class="col-md-6">
			
		</div>
	</div>
</div>
