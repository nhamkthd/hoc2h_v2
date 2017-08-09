		@verbatim	
			<div class="col-md-12 tab-content" >
				<div class="row">
					<div class="col-md-3" id="side-menu">
						<ul>
							<li class="category">Thông tin cá nhân
								<ul>
									<li><a ng-click="setSettingTab(1)" ng-class="{active:settingTab === 1}" href="">Sửa thông tin</a></li>
									<li><a ng-click="setSettingTab(2)" ng-class="{active:settingTab === 2}" href="">Quyền riêng tư</a></li>
									<li><a ng-click="setSettingTab(3)" ng-class="{active:settingTab === 3}" href="">Email và Mật khẩu</a></li>
								</ul>
							</li>
							<li class="category">Thông báo
								<ul>
									<li><a ng-click="setSettingTab(4)" ng-class="{active:settingTab === 4}" href="">Tin nhắn</a></li>
									<li><a ng-click="setSettingTab(5)" ng-class="{active:settingTab === 5}" href="">Người theo dõi</a></li>
									<li><a ng-click="setSettingTab(6)" ng-class="{active:settingTab === 6}" href="">Email</a></li>
								</ul>
							</li>
							<li class="category">Tương tác
								<ul>
									<li><a ng-click="setSettingTab(7)" ng-class="{active:settingTab === 7}" href="">Danh sách theo dõi</a></li>
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
										<a id="change-avtar" 
											ngf-select="uploadAvatar($file)" 
											ng-model="file" 
											name="file" 
											ngf-pattern="'image/*'"
										    ngf-accept="'image/*'" 
										    ngf-max-size="10MB" 
										    ngf-min-height="100"
										    ngf-resize="{width:500, height:500}">
										    {{avatar_text}}</a>
									</div>
								</div>
								<div class="col-md-8">
									<div class="row">
										<div class="col-md-5 form-info">
											<span>Tên hiển thị</span>
											<input type="text" class="form-control" ng-model="name_edit" placeholder="Cập nhật..." >
										</div>
										<div class="col-md-6 col-md-offset-1 form-info">
											<span>Lớp/Chuyên ngành</span>
											<input type="text" class="form-control" ng-model="class_edit" placeholder="Cập nhật..." >
										</div>
										<div class="col-md-5 form-info">
											<span>Ngày sinh</span>
									          <input type="text" class="form-control" 
									          		uib-datepicker-popup="{{format}}" 
									          		ng-model="birthday_edit" 
									          		is-open="popup1.opened"
									          		datepicker-options="dateOptions" 
									          		ng-required="true" 
									          		alt-input-formats="altInputFormats"
									          		ng-focus="birthdayFocus()" />
										</div>
										<div class="col-md-6 col-md-offset-1 form-info">
											<span>Số điện thoại</span>
											<input type="text" class="form-control" ng-model="phone_edit" placeholder="Cập nhật..." >
										</div>
										
										<div class="col-md-5 form-info">
											<span>Nơi ở</span>
											<select selector
													multi="false"
													model="local_edit"
													options="locals"
													label-attr="name"
													value-attr="name"
													placeholder="Cập nhật..."></select>
											
										</div>
										<div class="col-md-6 col-md-offset-1 form-info">
											<span>Giới tính</span>
											<div class="form-group gender-radio" >
											    <input name="gender_edit" type="radio" value="1" ng-checked="user.gender === 1"  ng-model="gender_edit">
											    <label for="radio4">Nam</label>
											    <input name="gender_edit" type="radio" value="0" ng-checked="user.gender === 0"  ng-model="gender_edit">
											    <label for="radio4">Nữ</label>
											    <input name="gender_edit" type="radio" value="2" ng-checked="user.gender === 2"  ng-model="gender_edit">
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
							<flash-message></flash-message>
							<div class="col-md-4 col-md-offset-4">
								<a style="width:40%;" href="/users/{{user.id}}/profile" class="btn btn-warning" type="button" >Huỷ bỏ</a>
								<button style="width: 40%;" class="btn btn-default" type="button" ng-click="editProfile()">Lưu lại </button>
							</div>
						</div>
					</div>
					<div ng-show="settingTab === 2">
						<div class="col-md-9">
							<h3 class="title-section">Cài đặt quyền riêng tư</h3>
							<div class="row private-setting" >
								<table class="setting-table">
									<tbody>
										<tr class="confirm">
											<td class="desc">
												<strong>Hiển trạng thái online</strong>
												<span>Cho phép mọi người thấy bạn khi đăng nhập </span>
											</td>
											<td class="action">
												<div class="TriSea-technologies-Switch pull-right">
						                            <input id="active_status-" name="TriSea1" type="checkbox"/>
						                            <label for="active_status" class="label-info"></label>
						                        </div>
											</td>
										</tr>
										<tr class="confirm">
											<td class="desc">
												<strong>Hiển thị ngày tháng năm sinh</strong>
												<span>Cho phép mọi người thấy được tuổi và sinh nhật của bạn</span>
											</td>
											<td class="action">
												<div class="TriSea-technologies-Switch pull-right">
						                            <input id="show_birthday" name="TriSea1" type="checkbox"/>
						                            <label for="show_birthday" class="label-info"></label>
						                        </div>
											</td>
										</tr>
										<tr class="confirm">
											<td class="desc">
												<strong>Hiển thị số điện thoại</strong>
												<span>Cho phép mọi người thấy được số điện thoại của bạn</span>
											</td>
											<td class="action">
												<div class="TriSea-technologies-Switch pull-right">
						                            <input id="show_phone" name="TriSea1" type="checkbox"/>
						                            <label for="show_phone" class="label-info"></label>
						                        </div>
											</td>
										</tr>
										<tr class="confirm">
											<td class="desc">
												<strong>Xem chi tiết trang cá nhân</strong>
												<span>Đối tượng có thể xem chi tiết trang cá nhân</span>
											</td>
											<td class="action">
												<div ng-init="show_profile_objects = [
																{name: 'Tất cả', id: 1},
																{name: 'Chỉ thành viên', id: 2},
																{name: 'Chỉ người theo dõi bạn', id: 3}]"></div>
												<select selector
														multi="false"
														model="show_profile"
														options="show_profile_objects"
														label-attr="name"
														value-attr="id"></select>
											</td>
										</tr>
										<tr class="confirm">
											<td class="desc">
												<strong>Gửi tin nhắn cho bạn</strong>
												<span>Đối tượng có thể bắt đầu nhắn tin</span>
											</td>
											<td class="action">
												<div ng-init="send_message_objects = [
																{name: 'Thành viên', id: 1},
																{name: 'Chỉ người theo dõi bạn', id: 2},]"></div>
												<select selector
														multi="false"
														model="send_message"
														options="send_message_objects"
														label-attr="name"
														value-attr="id"></select>
											</td>
										</tr>
									</tbody>
								</table>
								<button style="vertical-align: middle; width: 20%;margin-left:15px; margin-top:20px;" class="btn btn-default" type="button" ng-click="updateUserPrivate()">Lưu lại </button>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endverbatim