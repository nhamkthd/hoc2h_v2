<script type="text/ng-template" id="modal_delete.html">
  <div class="modal-header">
    <h3 class="modal-title">Xác nhận</h3>
  </div>
  <div class="modal-body">
    Bạn có chắc chắn muốn xóa group này không.nếu xóa các thành viên trong group này sẽ chuyển thành member !
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary" ng-click="ok()">Vẫn xóa</button>
    <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
  </div>
</script>