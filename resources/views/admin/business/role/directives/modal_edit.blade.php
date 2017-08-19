@verbatim
<script type="text/ng-template" id="editModal.html">
  <div class="modal-header">
    <h3 class="modal-title">Edit Role</h3>
  </div>
  <div class="modal-body">
    <form class="form-validate form-horizontal" name='form_edit'>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
          <label class="control-label col-lg-2">Title *</label>
            <div class="col-lg-8">
              <input type="text" required ng-model='title_edit' name="title_edit" class="form-control" placeholder="Tiêu đề">
               <span style="color: red" ng-show="form_edit.title_edit.$touched && form_edit.title_edit.$invalid">
               <span ng-show="form_edit.title_edit.$error.required">Vui lòng chọn title.</span>
             </span>
            </div>
          </div>
          <div class="form-group ">
          <label class="control-label col-lg-2">Description*</label>
          <div class="col-lg-8">
          <textarea required ng-model='description_edit' name="description_edit" class="form-control"></textarea>
            <span style="color: red" ng-show="form_edit.description_edit.$touched && form_edit.description_edit.$invalid">
             <span ng-show="form_edit.description_edit.$error.required">Vui lòng chọn description.</span>
           </span>
         </div>
          </div>
          </form>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary" ng-click="ok()" ng-disabled="form_edit.$invalid">OK</button>
    <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
  </div>
</script>
@endverbatim