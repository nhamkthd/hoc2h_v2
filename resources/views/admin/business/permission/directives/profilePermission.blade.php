<div class="container" style="margin-top: 50px">
	<div class="row show-grid">
		<div class="col-md-6">
			<div class="col-md-6">
			<label>Xem trang cá nhân:</label>
			</div>
			<div class="col-md-6">
				<input value="1" name="view_question" name="view_my_profile" type="checkbox" class="form-control" @if ($permission->view_my_profile)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Bắt đầu cuộc hội thoại:</label>
			</div>
			<div class="col-md-6">
				<input value="1" name="answer_question" name="start_conversations" type="checkbox" class="form-control" @if ($permission->start_conversations)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
	</div>


	<div class="row show-grid">
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Sửa trang cá nhân của chính mình:</label>
			</div>
			<div class="col-md-6">
				<input value="1" type="checkbox" name="edit_my_profile" class="form-control" @if ($permission->edit_my_profile)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Sửa trang cá nhân của tất cả mọi người:</label>
			</div>
			<div class="col-md-6">
				<input value="1" type="checkbox" name="edit_other_profile" class="form-control" @if ($permission->edit_other_profile)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
	</div>

	<div class="row show-grid">
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Thêm bạn bè:</label>
			</div>
			<div class="col-md-6">
				<input value="1" type="checkbox" name="add_friend" class="form-control" @if ($permission->add_friend)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Theo dõi người dùng:</label>
			</div>
			<div class="col-md-6">
				<input value="1" type="checkbox" name="follow_user" class="form-control" @if ($permission->follow_user)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
	</div>

		<div class="row show-grid">
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Xem trang cá nhân của người khác:</label>
			</div>
			<div class="col-md-6">
				<input value="1" type="checkbox" name="view_other_user_profile" class="form-control" @if ($permission->view_other_user_profile)
					checked
				@endif data-toggle="toggle">
			</div>
		</div>
		<div class="col-md-6">
			
		</div>
	</div>
</div>