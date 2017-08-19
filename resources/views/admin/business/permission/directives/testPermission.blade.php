<div class="container" style="margin-top: 50px">
	<div class="row show-grid">
		<div class="col-md-6">
			<div class="col-md-6">
			<label>Xem đề thi:</label>
			</div>
			<div class="col-md-6">
				<input value="1" name="view_test" type="checkbox" class="form-control" @if ($permission->view_test)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Tham gia thi:</label>
			</div>
			<div class="col-md-6">
				<input value="1" name="attend_test" type="checkbox" class="form-control" @if ($permission->attend_test)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
	</div>

	<div class="row show-grid">
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Bình luận bài thi:</label>
			</div>
			<div class="col-md-6">
				<input value="1" type="checkbox" name="comment_test" class="form-control" @if ($permission->comment_test)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Đánh giá bài thi:</label>
			</div>
			<div class="col-md-6">
				<input value="1" name="rate_test" type="checkbox" class="form-control" @if ($permission->rate_test)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
	</div>

	<div class="row show-grid">
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Sửa bài thi của chính mình:</label>
			</div>
			<div class="col-md-6">
				<input value="1" type="checkbox" name="edit_test_by_self" class="form-control" @if ($permission->edit_test_by_self)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Sửa tất cả đề thi của mọi người:</label>
			</div>
			<div class="col-md-6">
				<input value="1" type="checkbox" name="edit_test_by_everyone" class="form-control" @if ($permission->edit_test_by_everyone)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
	</div>


	<div class="row show-grid">
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Xóa đề thi của chính mình:</label>
			</div>
			<div class="col-md-6">
				<input value="1" type="checkbox" name="delete_test_by_self" class="form-control" @if ($permission->delete_test_by_self)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Xóa Tất cả đề thi của mọi người:</label>
			</div>
			<div class="col-md-6">
				<input value="1" type="checkbox" name="delete_test_by_everyone" class="form-control" @if ($permission->delete_test_by_everyone)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
	</div>


	

	<div class="row show-grid">
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Approve test create:</label>
			</div>
			<div class="col-md-6">
				<input value="1" type="checkbox" name="approve_test_create" class="form-control" @if ($permission->approve_test_create)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Ghim đề thi lên đầu trang:</label>
			</div>
			<div class="col-md-6">
				<input value="1" type="checkbox" name="stick_test" class="form-control" @if ($permission->stick_test)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
	</div>

		<div class="row show-grid">
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Tạo đề thi:</label>
			</div>
			<div class="col-md-6">
				<input value="1" type="checkbox" name="create_test" class="form-control" @if ($permission->create_test)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Xem gợi ý:</label>
			</div>
			<div class="col-md-6">
				<input value="1" type="checkbox" name="view_test_explan" class="form-control" @if ($permission->view_test_explan)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
	</div>

	<div class="row show-grid">
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Check user test:</label>
			</div>
			<div class="col-md-6">
				<input value="1" type="checkbox" name="check_user_test" class="form-control" @if ($permission->check_user_test)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
		<div class="col-md-6">
			
		</div>
	</div>
</div>