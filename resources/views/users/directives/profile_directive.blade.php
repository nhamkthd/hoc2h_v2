		@verbatim	
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
								<div class="user-description" ng-bind-html="user.description">
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
											<li><i class="fa fa-map-marker" aria-hidden="true"></i>{{user.local}}</li>
											<li><i class="fa fa-phone" aria-hidden="true"></i>{{user.phone}}</li>
											<li><i class="fa fa-intersex" aria-hidden="true"></i></li>
											<li><i class="fa fa-birthday-cake" aria-hidden="true"></i>{{user.birthday}}</li>
											<li><i class="fa fa-graduation-cap" aria-hidden="true"></i>{{user.class}} </li>
											<li><i class="fa fa-clock-o" aria-hidden="true"></i>tham gia ngày {{user.created_at}}</li>
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
			@endverbatim