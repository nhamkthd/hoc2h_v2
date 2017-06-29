					<form class="form-horizontal" method="POST" accept="">
						<fieldset>
							<!-- Form Name -->
							<legend>Đăng câu hỏi</legend>
							<!-- Select Basic -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="selectbasic">Thể loại</label>
								<div class="col-md-5">
									<select id="selectbasic" name="selectbasic" class="form-control">
										<option value="1">Văn Học</option>
										<option value="2">THPT</option>
									</select>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="title">Tiêu đề</label>  
								<div class="col-md-8">
									<input id="title" name="title" type="text" placeholder="Tiêu đề" class="form-control input-md" required="">

								</div>
							</div>
							<!-- Textarea -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="textarea">Nội dung</label>
								<div class="col-md-8">                     
									<textarea class="form-control" id="textarea" name="textarea"  placeholder="Nội dung"></textarea>
								</div>
							</div>
							<!-- Button (Double) -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="cancel"></label>
								<div class="col-md-8">
								<button id="cancel" name="cancel" class="btn btn-default">Huỷ bỏ</button>
								<button id="submit" name="submit" class="btn btn-main">Đăng lên</button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>