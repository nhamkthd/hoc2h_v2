@extends('admin.layouts.master')
@section('content')
<section class="content-header">
  <h1>
    Phân quyền cho {{$role->title}}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">permission</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- Custom Tabs -->
      <div class="nav-tabs-custom">
        <form method="post" action="{{ url('admin/permission/update') }}">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Hỏi đáp</a></li>
          <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Đề thi</a></li>
          <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Tài liệu</a></li>
          <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Trang cá nhân</a>
          <li class="pull-right"><input type="submit" class="btn btn-defaul" value="Lưu thay đổi"></li>
        </ul>
        {{csrf_field()}}
        <input type="hidden" name="role_id" value="{{$role->id}}">
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            @include('admin.business.permission.directives.questionPermission')
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_2">
           @include('admin.business.permission.directives.testPermission')
         </div>
         <!-- /.tab-pane -->
         <div class="tab-pane" id="tab_3">
           @include('admin.business.permission.directives.documentPermission')
         </div>
         <!-- /.tab-pane -->
         <div class="tab-pane" id="tab_4">
           @include('admin.business.permission.directives.profilePermission')
         </div>
       </div>
       </form>
       <!-- /.tab-content -->
     </div>
     <!-- nav-tabs-custom -->
   </div>
   <!-- /.col -->
 </div>
</section>
@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    $("input[type=checkbox]").change(function() {
      $(this).attr("value", $(this).prop("checked") ? 1 : 0); 
    });
  });
</script>
@endsection
@stop