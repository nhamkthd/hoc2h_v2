<style>
	.tab-bar {padding:0px;}
	.tab-bar ul {list-style-type: none; margin: 0; padding: 0; overflow: hidden; background-color:#fff; border-bottom: 1px solid #e4e6e8; } 
	.tab-bar li {float: left;}
	.tab-bar li a {display: block; color:#607d8b; text-align: center; padding: 14px 16px; text-decoration: none; }
	.tab-bar li a:hover:not(.active) {color: #455a64 ; border-bottom: solid 3px #3F729B; } 
	.tab-bar li .active {color: #0d47a1; border-bottom: solid 3px #2BBBAD; } 

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
	 td .summary-wrapper {width: 33.3%; vertical-align: top; } 
	.summary-wrapper:first-child {padding-left: 0;}
	.summary-number {display: block; margin-bottom: 20px; text-align: center; padding: 7px;background-color: #fff8e2; border-color: #ece3c8;} 
	.summary-content .summary-number .name {text-transform: uppercase; color: #999; font-size: 11px; font-weight: 700;}
    .summary-content .summary-number .number {font-size: 24px; display: block; margin: 6px 0 4px 0; }
</style>
@extends('users.layouts')
@section('user_content')
	<div ng-init="getUser({{$user_id}})"></div>
	<div class="col-md-12 tab-bar">
		<ul>
		  <li ng-class="{active:currentTab === 1}"><a class="active" href="#home">Thôn tin chung</a></li>
		  <li ng-class="{active:currentTab === 2}"><a href="#news">Hoạt động</a></li>
		  <li ng-class="{active:currentTab === 3}"><a href="#contact">Cài đặt</a></li>
		  <li ng-class="{active:currentTab === 4}"><a href="#about">...</a></li>
		</ul>
	</div>
	<div class="col-md-12 tab-content">
		<div class="row">
			<div class="col-md-3 side-info">
				<div class="avt-card">
					<div class="avatar">
						<img src="" width="164" height="164">
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
						<h3 class="author-name">Tran Nham</h3>
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
							</td>
							<td class="summary-wrapper">
								<div class="summary-number">
									<span class="name">Đề Thi</span>
									<span class="number">289</span>
								</div>
							</td>
							<td class="summary-wrapper">
								<div class="summary-number">
									<span class="name">Tài liệu</span>
									<span class="number">162</span>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection