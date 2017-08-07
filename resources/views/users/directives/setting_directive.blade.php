		@verbatim	
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
				</div>
			</div>
		@endverbatim