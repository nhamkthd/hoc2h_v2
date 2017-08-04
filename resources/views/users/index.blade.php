<style>
	.list-unstyled { list-style: none;margin-left: 0;}
	.tab-bar {padding:0px;}
	.tab-bar ul {list-style-type: none; margin: 0; padding: 0; overflow: hidden; background-color:#fff; border-bottom: 1px solid #e4e6e8; } 
	.tab-bar li {float: left; margin-right:5px;}
	.tab-bar li a {display: block; color:#607d8b; text-align: center; padding: 14px 16px; text-decoration: none; }
	.tab-bar li:hover:not(.selected) a {color: #455a64 ; border-bottom: solid 3px #3F729B; } 
	.tab-bar li.selected a{color:#2BBBAD; border-bottom: solid 3px #2BBBAD;} 

	.tab-content {padding: 30px 10px;}

	.side-info {}
	.avt-card {border: 1px solid #c8ccd0;border-radius:2px; text-align:center;}
	.avt-card .avatar {width: 164px; height: 164px; overflow: hidden; margin: auto; margin-top:40px;}
	.avt-card .coin-info {padding: 12px 0;font-size: 22px;font-weight: 300;color: #181a1c;}
	.avt-card .coin-info .label-uppercase {vertical-align: middle;}
	.label-uppercase {text-transform: uppercase;font-size: 11px;font-weight: 500;color: #999;}
	.avt-card .actions {padding: 10px; color: #3F729B; margin-bottom:30px;}
	.avt-card .actions span {margin-left: 10px; padding: 5px 10px; border:solid 1px #e0e1e3; border-radius:2px; cursor: pointer;}
	.avt-card .actions span:first-child {margin-left:0;}
	.avt-card .actions span:hover {color: #0d47a1;}
	
	.main-info {padding-left: 20px;}
	.main-info .about {height: 278px; overflow-y: auto; overflow-x: hidden; padding-right: 20px; margin-right: 20px; max-width: 63%; }
	h3.author-name  {margin-top: 0px;}
	.user-description {font-size: 15px; line-height: 20px; padding-right: 20px;}
	.main-info .user-contact {color: #6a737c;position: relative;}
	.user-status .number {display: block; color: #0C0D0E; font-weight: 700; font-size: 17px;color: #FF8800;} 
	.contact-info {margin-top: 20px;}
	.contact-list {list-style: none;margin-left: 0;}
	.contact-list li {padding-top: 10px;}
	.contact-list i {font-size: 17px; margin-right: 10px;}

	.summary{margin-top: 20px;}
	h3.title-section {font-weight: 700; margin-bottom: 16px; border-bottom: 1px solid #e4e6e8; padding-bottom: 10px; font-size: 15px; }
	#summary-table {border-spacing: 0;border-collapse: collapse; width: 100%;}
	td.summary-wrapper {width: 33.3%; vertical-align: top; } 
	.summary-wrapper:first-child {padding-left: 0;border-left: none;}
	.summary-wrapper{border-left: 1px solid #e4e6e8;padding: 0 15px;}
	.summary-number {display: block; margin-bottom: 20px; text-align: center; padding: 7px;background-color:#e0f2f1; border-color: #ece3c8;} 
	.summary-number .name {text-transform: uppercase; color: #999; font-size: 11px; font-weight: 700;}
    .summary-number .number {font-size: 24px; display: block; margin: 6px 0 4px 0; }
    .summary-detail h5 {margin:10px 0; font-size: 13px; display: block;}
 	.detail-list {margin-bottom: 0;}
    .detail-list li {margin-bottom: 6px; font-size: 13px;}
    .detail-list li i {color: #FF8800; font-size: 9px; margin-right:5px;}
    .detail-list li span { color: #0099CC; float: right;}

    #side-menu {margin:16px 0 0;}
    #side-menu ul li.category {color: #0099CC; text-transform: uppercase; font-size: 12px; padding-bottom:20px;}
    #side-menu ul ul {margin-top:8px; }
    #side-menu ul ul li {position: relative;display: block; text-transform:none;margin-bottom:10px;}
    #side-menu ul ul li > a {padding-left: 0px; color:#848d95; font-size:13px;}
    #side-menu ul ul li > a:hover:not(.active) {color:#4B515D;}
    #side-menu ul ul li > a.active {color:#242729;font-weight:bold;}
    .edit-profile .avatar-wrapper {position: relative; width: 164px; height: 164px; overflow: hidden;}
    .avatar-wrapper #change-avtar {position: absolute; bottom: 0; left: 0; right: 0; background: rgba(12,13,14,0.6); border: 0; border-radius: 0 0 3px 3px; color: #FFF; text-align: center; padding: 8px 0; width: auto; transition: background .3s ease; }
    .edit-profile {border-bottom: 1px solid #eaeaea; padding: 0 10px 20px 10px;}
	.form-info span { font-weight: bold; font-size: 12px;}
	.gender-radio label {margin-right: 10px;font-weight: normal;}
</style>
@extends('users.layouts')
@section('user_content')
	<div ng-init="getUser({{$user_id}},{{$currentTab}})"></div>
	<div class="col-md-12 tab-bar">
		<ul>
		  <li ng-class="{selected:currentTab === 1}"><a href="{{url('/users/'.$user_id.'/profile')}}">Thông tin chung</a></li>
		  <li ng-class="{selected:currentTab === 2}"><a href="{{url('/users/'.$user_id.'/activity')}}">Hoạt động</a></li>
		  <li ng-class="{selected:currentTab === 3}"><a href="{{url('/users/'.$user_id.'/setting')}}">Cài đặt</a></li>
		</ul>
	</div>
	@verbatim
		<div ng-show="currentTab === 1">
			<div class="col-md-12 tab-content">
				<div class="row">
					<div class="col-md-3 side-info">
						<div class="avt-card">
							<div class="avatar">
								<img src="{{user.avatar}}" width="164" height="164">
							</div>
							<div class="coin-info">
								2679
								<span class="label-uppercase">coin</span>
							</div>
							<div class="actions">
								<span><i class="fa fa-user-plus" aria-hidden="true"></i></span>
								<span><i class="fa fa-comment" aria-hidden="true"></i></span>
								<span><i class="fa fa-ellipsis-h" aria-hidden="true"></i></span>
							</div>
						</div>
					</div>
					<div class="col-md-9 main-info">
						<div class="row">
							<div class="col-md-8 about">
								<h3 class="author-name">{{user.name}}</h3>
								<div class="user-description">
									<p>
									Trong các cuộc họp, hội thảo, gặp mặt thượng đế, giới thiệu loại sản phẩm,… kỹ năng thuyết trình là vô cùng quan trọng đối với mỗi người. Đặc biệt, khi thuyết trình bằng tiếng Anh, bạn cần làm cho bài thuyết trình có bố cục rõ ràng, dẫn dắt hợp lý.</p>
								</div>
							</div>
							<div class="col-md-4 user-contact">
								<div class="row user-status">
									<div class="col-md-4">
										<span class="number">127</span>
										theo dõi</div>
									<div class="col-md-4"><span class="number">315</span>bài đăng</div>
									<div class="col-md-4"><span class="number">95%</span>uy tín</div>
								</div>
								<div class="contact-info">
									<ul class="contact-list">
										<li><i class="fa fa-map-marker" aria-hidden="true"></i>Hà Nội</li>
										<li><i class="fa fa-phone" aria-hidden="true"></i>01663723154</li>
										<li><i class="fa fa-intersex" aria-hidden="true"></i>Nữ</li>
										<li><i class="fa fa-birthday-cake" aria-hidden="true"></i>26/03/1992</li>
										<li><i class="fa fa-graduation-cap" aria-hidden="true"></i>IT Engineer </li>
										<li><i class="fa fa-clock-o" aria-hidden="true"></i>tham gia ngày 27/07/2017</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row summary">
					<div class="col-md-9 col-md-offset-3 summary-content">
						<h3 class="title-section">Tổng quan</h3>
						<table id="summary-table">
							<tbody>
								<tr>
									<td class="summary-wrapper ">
										<div class="summary-number">
											<span class="name">Hỏi Đáp</span>
											<span class="number">156</span>
										</div>
										<div class="summary-detail">
											<h5>Chi tiết</h5>
											<ul class="detail-list list-unstyled">
												<li>
													<i class="fa fa-circle" aria-hidden="true"></i>Câu hỏi đã đăng
													<span>79</span>
												</li>
												<li>
													<i class="fa fa-circle" aria-hidden="true"></i>Câu hỏi trả lời
													<span>77</span>
												</li>
												<li>
													<i class="fa fa-circle" aria-hidden="true"></i>Điểm thành tích
													<span>236</span>
												</li>
											</ul>
										</div>
									</td>
									<td class="summary-wrapper">
										<div class="summary-number">
											<span class="name">Đề Thi</span>
											<span class="number">289</span>
										</div>
										<div class="summary-detail">
											<h5>Chi tiết</h5>
											<ul class="detail-list list-unstyled">
												<li>
													<i class="fa fa-circle" aria-hidden="true"></i>Đề đã tạo
													<span>0</span>
												</li>
												<li>
													<i class="fa fa-circle" aria-hidden="true"></i>Đề đã làm
													<span>289</span>
												</li>
												<li>
													<i class="fa fa-circle" aria-hidden="true"></i>Điểm đánh giá
													<span>8</span>
												</li>
											</ul>
										</div>
									</td>
									<td class="summary-wrapper">
										<div class="summary-number">
											<span class="name">Tài liệu</span>
											<span class="number">162</span>
										</div>
										<div class="summary-detail">
											<h5>Chi tiết</h5>
											<ul class="detail-list list-unstyled">
												<li>
													<i class="fa fa-circle" aria-hidden="true"></i>Đã tạo
													<span>42</span>
												</li>
												<li>
													<i class="fa fa-circle" aria-hidden="true"></i>Đã tải
													<span>120</span>
												</li>
												<li>
													<i class="fa fa-circle" aria-hidden="true"></i>Điểm thành tích
													<span>120</span>
												</li>
											</ul>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div ng-show="currentTab === 2">
			Activity time line
		</div>

		<div ng-show="currentTab === 3">
			<div class="col-md-12 tab-content">
				<div class="row">
					<div class="col-md-3" id="side-menu">
						<ul>
							<li class="category">Thông tin cá nhân
								<ul>
									<li><a ng-class="{active:settingTab === 1}" href="">Sửa thông tin</a></li>
									<li><a ng-class="{active:settingTab === 2}" href="">Quyền riêng tư</a></li>
									<li><a ng-class="{active:settingTab === 3}" href="">Thông tin khác</a></li>
								</ul>
							</li>
							<li class="category">Thông báo
								<ul>
									<li><a ng-class="{active:settingTab === 4}" href="">Tin nhắn</a></li>
									<li><a ng-class="{active:settingTab === 5}" href="">Người theo dõi</a></li>
									<li><a ng-class="{active:settingTab === 6}" href="">Email</a></li>
								</ul>
							</li>
							<li class="category">Tương tác
								<ul>
									<li><a ng-class="{active:settingTab === 7}" href="">Danh sách theo dõi</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div ng-show="settingTab === 1">
						<div class="col-md-9">
							<h3 class="title-section">Sửa thông tin cá nhân</h3>
							<div class="row edit-profile">
								<div class="col-md-3">
									<div class="avatar-wrapper">
										<img src="{{user.avatar}}" width="164" height="164">
										<a id="change-avtar">Thay đổi ảnh đại diện</a>
									</div>
								</div>
								<div class="col-md-8">
									<div class="row">
										<div class="col-md-5 form-info">
											<span>Tên hiển thị</span>
											<input type="text" class="form-control" ng-model="name_edit" value="{{user.name}}" placeholder="Cập nhật..." >
										</div>
										<div class="col-md-6 col-md-offset-1 form-info">
											<span>Lớp/Chuyên ngành</span>
											<input type="text" class="form-control" ng-model="class_edit" value="{{user.class}}" placeholder="Cập nhật..." >
										</div>
										<div class="col-md-5 form-info">
											<span>Ngày sinh</span>
											<input type="text" name="birthday" ng-model="birthday_edit" class="form-control" placeholder="Cập nhật..." value="{{user.birthday}}">
										</div>
										<div class="col-md-6 col-md-offset-1 form-info">
											<span>Số điện thoại</span>
											<input type="text" class="form-control" ng-model="phone_edit" value="{{user.phone}}" placeholder="Cập nhật..." >
										</div>
										
										<div class="col-md-5 form-info">
											<span>Nơi ở</span>
											<select selector
													multi="false"
													model="local_edit"
													name="local"
													options="locals"
													label-attr="name"
													placeholder="Cập nhật..."></select>
											
										</div>
										<div class="col-md-6 col-md-offset-1 form-info">
											<span>Giới tính</span>
											<div class="form-group gender-radio" ng-model="gender_edit">
											    <input name="group2" type="radio" class="with-gap" id="radio4" value="1" checked="user.gender === 1">
											    <label for="radio4">Nam</label>
											    <input name="group2" type="radio" class="with-gap" id="radio4" value="0" checked="user.gender === 0">
											    <label for="radio4">Nữ</label>
											    <input name="group2" type="radio" class="with-gap" id="radio4" value="2" checked="user.gender === 2">
											    <label for="radio4">Khác</label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-11" style="padding:10px 0px 10px 10px; margin-top:20px;" >
									<label>Giới thiệu bản thân</label>
									<div ckeditor="options" ng-model="description_edit" ready="onReady()"></div>
								</div>
							</div>
							<div class="col-md-4 col-md-offset-4">
								<a style="width:40%;" href="" class="btn btn-warning" type="button" >Huỷ bỏ</a>
								<button style="width: 40%;" class="btn btn-default" type="button" ng-click="editProfile()">Lưu lại </button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endverbatim
@endsection