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
									<li><a ng-click="setSettingTab(4)" ng-class="{active:settingTab === 4}" href="">Email và thông báo</a></li>
								</ul>
							</li>
							<li class="category">Cài đặt khác
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
									       <!--  <input type="text" class="form-control" ng-model="birthday_edit"/> -->
									        <input type="date" 
									        		id="birthday_edit" 
									        		name="birthday_edit" 
									        		ng-model="birthday_edit"
       												placeholder="Cập nhật..."
       												min="01-01-1970" 
       												max="31-12-2005" style="height: 38px;margin-top: 4px" />
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
						                            <input 	id="active_state" type="checkbox" 
						                            		ng-checked="show_active == 1" 
						                            		ng-model="show_active" 
						                            		ng-true-value="1" 
						                            		ng-false-value="0"/>
						                            <label for="active_state" class="label-info"></label>
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
						                            <input 	id="show_birthday"  type="checkbox" 
						                            		ng-checked="show_birthday == 1"
						                            		ng-model="show_birthday" 
						                            		ng-true-value="1" 
						                            		ng-false-value="0"/>
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
						                            <input 	id="show_phone"  type="checkbox" 
						                            		ng-checked="show_phone == 1" 
						                            		ng-model="show_phone"
						                            		ng-true-value="1" 
						                            		ng-false-value="0" />
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
								<flash-message></flash-message>
								<button style="vertical-align: middle; width: 20%;margin-left:15px; margin-top:20px;" class="btn btn-default" type="button" ng-click="updateUserPrivate()">Lưu lại </button>
							</div>
						</div>
					</div>
					<div ng-show="settingTab === 3">
						<div class="col-md-9" >
							<h3 class="title-section">Cài đặt Emai</h3>
							<div class="row" style="padding-left:10px;">
								<div class="col-md-12"><label>Địa chỉ email</label></div>
								<div class="col-md-7"
								>
									<flash-message></flash-message>
								</div>
								<div class="col-md-6">
									<input class="form-control" type="email" ng-model="email" 
									 placeholder="me@example.com">
								</div>
								<div class="col-md-2">
									<button class="btn btn-default" ng-click="changeEmail()">Thay đổi</button>
								</div>
							</div>
							<h3 class="title-section">Đổi mật khẩu</h3>
							<div class="row" style="padding-left:10px;">	
								<label class="col-md-8">Mật khẩu hiện tại</label>
								<div class="col-md-6">
									<input class="form-control" type="password" ng-model="current_password">
								</div>
								<label class="col-md-8">Mật khẩu mới</label>
								<div class="col-md-6">
									<input class="form-control" type="password" ng-model="new_password">
								</div>
								<label class="col-md-8">Xác nhận mật khẩu mới</label>
								<div class="col-md-6">
									<input class="form-control" type="password" ng-model="confirm_new_password">
								</div>
							</div>	
							<div class="row">
								<div class="col-md-2">
									<button  class="btn btn-default">Lưu thay đổi</button>
								</div>
							</div>		
						</div>
					</div>
					<div ng-show="settingTab === 4">
						<div class="col-md-9">
							<h3 class="title-section">Cài đặt thông báo</h3>
							<div class="row private-setting" >
								<table class="setting-table">
									<tbody>
										<tr class="confirm">
											<td class="desc">
												<strong>Người bạn đang theo dõi</strong>
												<span>Nhận thông báo hoặc email khi người bạn theo dõi đăng 1 bài viết mới</span>
											</td>
											<td class="action">
												<div class="TriSea-technologies-Switch pull-right">
													<span>Thông báo</span>
						                            <input 	id="peoples_following" type="checkbox" 
						                            		ng-checked="peoples_following == 1" 
						                            		ng-model="peoples_following" 
						                            		ng-true-value="1" 
						                            		ng-false-value="0"/>
						                            <label for="peoples_following" class="label-info"></label>
						                        </div>
											</td>
											<td class="action">
												<div class="TriSea-technologies-Switch pull-right">
													<span>Gửi email</span>
						                            <input 	id="email_peoples_following" type="checkbox" 
						                            		ng-checked="email_peoples_following == 1" 
						                            		ng-model="email_peoples_following" 
						                            		ng-true-value="1" 
						                            		ng-false-value="0"/>
						                            <label for="email_peoples_following" class="label-info"></label>
						                        </div>
											</td>
										</tr>
										<tr class="confirm">
											<td class="desc">
												<strong>Bài viết đang theo dõi</strong>
												<span>Nhận thông báo hoặc email khi bài viết bạn đang theo dõi có cập nhật</span>
											</td>
											<td class="action">
												<div class="TriSea-technologies-Switch pull-right">
													<span>Thông báo</span>
						                            <input 	id="post_following" type="checkbox" 
						                            		ng-checked="post_following == 1" 
						                            		ng-model="post_following" 
						                            		ng-true-value="1" 
						                            		ng-false-value="0"/>
						                            <label for="post_following" class="label-info"></label>
						                        </div>
											</td>
											<td class="action">
												<div class="TriSea-technologies-Switch pull-right">
													<span>Gửi email</span>
						                            <input 	id="email_post_following" type="checkbox" 
						                            		ng-checked="email_post_following == 1" 
						                            		ng-model="email_post_following" 
						                            		ng-true-value="1" 
						                            		ng-false-value="0"/>
						                            <label for="email_post_following" class="label-info"></label>
						                        </div>
											</td>
										</tr>
										<tr class="confirm">
											<td class="desc">
												<strong>Bài viết của bạn</strong>
												<span>Nhận thông báo hoặc email khi có cập nhật về bài viết của bạn</span>
											</td>
											<td class="action">
												<div class="TriSea-technologies-Switch pull-right">
													<span>Thông báo</span>
						                            <input 	id="your_post"  type="checkbox" 
						                            		ng-checked="your_post == 1"
						                            		ng-model="your_post" 
						                            		ng-true-value="1" 
						                            		ng-false-value="0"/>
						                            <label for="your_post" class="label-info"></label>
						                        </div>
											</td>
											<td class="action">
												<div class="TriSea-technologies-Switch pull-right">
													<span>Gửi email</span>
						                            <input 	id="email_your_post"  type="checkbox" 
						                            		ng-checked="email_your_post == 1"
						                            		ng-model="email_your_post" 
						                            		ng-true-value="1" 
						                            		ng-false-value="0"/>
						                            <label for="email_your_post" class="label-info"></label>
						                        </div>
											</td>
										</tr>
										<tr class="confirm">
											<td class="desc">
												<strong>Người theo dõi</strong>
												<span>Nhận thông báo khi có người bắt đầu theo dõi bạn</span>
											</td>
											<td class="action">
												<div class="TriSea-technologies-Switch pull-right">
													<span>Thông báo</span>
						                            <input 	id="new_follower"  type="checkbox" 
						                            		ng-checked="new_follower == 1" 
						                            		ng-model="new_follower"
						                            		ng-true-value="1" 
						                            		ng-false-value="0" />
						                            <label for="new_follower" class="label-info"></label>
						                        </div>
											</td>
											<td class="action">
												<div class="TriSea-technologies-Switch pull-right">
													<span>Gửi email</span>
						                            <input 	id="email_new_follower"  type="checkbox" 
						                            		ng-checked="email_new_follower == 1" 
						                            		ng-model="email_new_follower"
						                            		ng-true-value="1" 
						                            		ng-false-value="0" />
						                            <label for="email_new_follower" class="label-info"></label>
						                        </div>
											</td>
										</tr>
										<tr class="confirm">
											<td class="desc">
												<strong>Tin nhắn</strong>
												<span>Nhận thông báo khi có người bắt đầu nhắn tin cho bạn</span>
											</td>
											<td class="action">
												<div class="TriSea-technologies-Switch pull-right">
													<span>Thông báo</span>
						                            <input 	id="new_message"  type="checkbox" 
						                            		ng-checked="new_message == 1" 
						                            		ng-model="new_message"
						                            		ng-true-value="1" 
						                            		ng-false-value="0" />
						                            <label for="new_message" class="label-info"></label>
						                        </div>
											</td>
											<td class="action">
												<div class="TriSea-technologies-Switch pull-right">
													<span>Gửi email</span>
						                            <input 	id="email_new_message"  type="checkbox" 
						                            		ng-checked="email_new_message == 1" 
						                            		ng-model="email_new_message"
						                            		ng-true-value="1" 
						                            		ng-false-value="0" />
						                            <label for="email_new_message" class="label-info"></label>
						                        </div>
											</td>
										</tr>
										<tr class="confirm">
											<td class="desc">
												<strong>Câu hỏi có thể trả lời</strong>
												<span>Nhận thông báo khi có câu hỏi mới mà bạn có thể trả lời</span>
											</td>
											<td class="action">
												<div class="TriSea-technologies-Switch pull-right">
													<span>Thông báo</span>
						                            <input 	id="question_can_answer"  type="checkbox" 
						                            		ng-checked="question_can_answer == 1" 
						                            		ng-model="question_can_answer"
						                            		ng-true-value="1" 
						                            		ng-false-value="0" />
						                            <label for="question_can_answer" class="label-info"></label>
						                        </div>
											</td>
											<td class="action">
												<div class="TriSea-technologies-Switch pull-right">
													<span>Gửi email</span>
						                            <input 	id="email_question_can_answer"  type="checkbox" 
						                            		ng-checked="email_question_can_answer == 1" 
						                            		ng-model="email_question_can_answer"
						                            		ng-true-value="1" 
						                            		ng-false-value="0" />
						                            <label for="email_question_can_answer" class="label-info"></label>
						                        </div>
											</td>
										</tr>
										<tr class="confirm">
											<td class="desc">
												<strong>Yêu cầu trả lời</strong>
												<span>Nhận thông báo khi người yêu cầu bạn trả lời</span>
											</td>
											<td class="action">
												<div class="TriSea-technologies-Switch pull-right">
													<span>Thông báo</span>
						                            <input 	id="request_answer"  type="checkbox" 
						                            		ng-checked="request_answer == 1" 
						                            		ng-model="request_answer"
						                            		ng-true-value="1" 
						                            		ng-false-value="0" />
						                            <label for="request_answer" class="label-info"></label>
						                        </div>
											</td>
											<td class="action">
												<div class="TriSea-technologies-Switch pull-right">
													<span>Gửi email</span>
						                            <input 	id="email_request_answer"  type="checkbox" 
						                            		ng-checked="email_request_answer == 1" 
						                            		ng-model="email_request_answer"
						                            		ng-true-value="1" 
						                            		ng-false-value="0" />
						                            <label for="email_request_answer" class="label-info"></label>
						                        </div>
											</td>
										</tr>
										<tr class="confirm">
											<td class="desc">
												<strong>Điểm thay đổi</strong>
												<span>Nhận thông báo khi điểm thành tích của bạn thay đổi</span>
											</td>
											<td class="action">
												<div class="TriSea-technologies-Switch pull-right">
													<span>Thông báo</span>
						                            <input 	id="coin_change"  type="checkbox" 
						                            		ng-checked="coin_change == 1" 
						                            		ng-model="coin_change"
						                            		ng-true-value="1" 
						                            		ng-false-value="0" />
						                            <label for="coin_change" class="label-info"></label>
						                        </div>
											</td>
											<td class="action">
												<div class="TriSea-technologies-Switch pull-right">
													<span>Gửi email</span>
						                            <input 	id="email_coin_change"  type="checkbox" 
						                            		ng-checked="email_coin_change == 1" 
						                            		ng-model="email_coin_change"
						                            		ng-true-value="1" 
						                            		ng-false-value="0" />
						                            <label for="email_coin_change" class="label-info"></label>
						                        </div>
											</td>
										</tr>
									</tbody>
								</table>
								<flash-message></flash-message>
								<button style="vertical-align: middle; width: 20%;margin-left:15px; margin-top:20px;" class="btn btn-default" type="button" ng-click="updateNotifcationSetting()">Lưu lại </button>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endverbatim