<script type="text/ng-template" id="myModalContent.html">
  <div class="modal-header">
    <h3 class="modal-title">Add Role</h3>
  </div>
  <div class="modal-body">
    <form class="form-validate form-horizontal" name='form_role'>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group ">
          <label class="control-label col-lg-2">Level *</label>
             <div class="col-lg-8">
                <select name="permisstion" required ng-model='level' class="form-control">
                 <option value="">Chọn</option>
                 <option value="1">Super</option>
                 <option value="2">Admin</option>
                 <option value="3">mode</option>
                 <option value="4">Member</option>
                </select>
                <span style="color:red" ng-show="form_role.permisstion.$touched && form_role.permisstion.$invalid">
                 <span ng-show="form_role.permisstion.$error.required">Vui lòng chọn permisstion.</span>
                </span>
            </div>
          </div>
          <div class="form-group">
          <label class="control-label col-lg-2">Title *</label>
            <div class="col-lg-8">
              <input type="text" ng-model='title' required name="title" class="form-control" placeholder="Tiêu đề">
              <span style="color:red" ng-show="form_role.title.$touched && form_role.title.$invalid">
               <span ng-show="form_role.title.$error.required">Vui lòng chọn title.</span>
             </span>
            </div>
          </div>
          <div class="form-group">
          <label class="control-label col-lg-2">Description*</label>
            <div class="col-lg-8">
              <input type="text" ng-model='description' required name="description" class="form-control" placeholder="Miêu tả">
              <span style="color:red" ng-show="form_role.description.$touched && form_role.description.$invalid">
               <span ng-show="form_role.description.$error.required">Vui lòng chọn description.</span>
             </span>
            </div>
          </div>
          </form>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary" ng-disabled="form_role.$invalid" ng-click="ok()">OK</button>
    <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
  </div>
</script>