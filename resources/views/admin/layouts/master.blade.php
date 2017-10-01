<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="csrf_token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Hoc2H') }}</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href='{{asset("template/bootstrap/css/bootstrap.min.css")}}'>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->

  <link rel="stylesheet" href='{{asset("template/plugins/jvectormap/jquery-jvectormap-1.2.2.css")}}'>
  <!-- Theme style -->
  <link rel="stylesheet" href='{{asset("template/dist/css/AdminLTE.min.css")}}'>
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href='{{asset("template/plugins/jquery-nestable/jquery.nestable.css")}}'>
  <link rel="stylesheet" href='{{asset("template/dist/css/skins/_all-skins.min.css")}}'>
  
  <link rel="stylesheet" href='{{asset("template/plugins/datatables/dataTables.bootstrap.css")}}'>
  <script src='{{asset("/template/plugins/jQuery/jquery-2.2.3.min.js")}}'></script> 
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script src='{{asset("/template/plugins/jquery-nestable/jquery.nestable.js")}}'></script>
  <script src="{{asset('js/flugin/angular/angular.min.js')}}"></script> 
  <script src="{{asset('js/flugin/angular/ng-tags-input.js')}}"></script> 
  <script src="{{asset('js/flugin/angular/ng-nestable.js')}}"></script> 
  <script src="{{asset('js/flugin/angular/angular-selector.js')}}"></script> 
  <script src="{{asset('js/flugin/angular/ng-infinite-scroll.js')}}"></script>
  <script src="{{asset('js/flugin/angular/ng-scrollbar.js')}}"></script> 
  <script src="{{asset('js/flugin/angular/ng-file-upload-shim.js')}}"></script> 
  <script src="{{asset('js/flugin/angular/ng-file-upload.js')}}"></script>
  <script src="{{asset('js/flugin/angular/angular-flash.js')}}"></script>  
  <script src="{{asset('js/flugin/angular/angular-ckeditor.js')}}"></script>
  <script src="{{asset('js/flugin/bootstrap/ui-bootstrap-tpls-2.5.0.min.js')}}"></script>
  <script src="{{asset('js/controllers/admin/app.js')}}"></script>
  <script src="{{asset('js/controllers/admin/role.js')}}"></script>
  <script src="{{asset('js/controllers/admin/user.js')}}"></script>
  <script src="{{asset('js/controllers/admin/category.js')}}"></script>
   <script src="{{asset('js/flugin/notify/bootstrap-notify.js')}}"></script>
  <script src="{{asset('js/flugin/notify/bootstrap-notify.min.js')}}"></script>
  <script type="text/javascript">
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
      }
    });
  </script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  @yield('style')
  <style type="text/css">
    #loading{
      background: url({{ asset('img/loading.gif') }}) center no-repeat #fff;
      position: fixed;
      left: 0px;
      top: 0px,;
      width: 100%;
      height: 100%;
      z-index: 9999
    }
    .show-grid {
      margin-bottom: 15px;
    }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini" >
<div class="loading" id="loading"></div>
  <div class="wrapper">
    @include('admin.partials.header')
    @include('admin.partials.sidebars')
    <div class="content-wrapper">
      @yield('content')
    </div>
    @include('admin.partials.footer')
    <!-- Control Sidebar -->
    
    <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->

<!-- Bootstrap 3.3.7 -->
<script src='{{asset("/template/bootstrap/js/bootstrap.min.js")}}'></script>
<!-- FastClick -->
<script src='{{asset("/template/plugins/fastclick/fastclick.js")}}'></script>
<!-- AdminLTE App -->
<script src='{{asset("/template/dist/js/app.min.js")}}'></script>
<!-- Sparkline -->
<script src='{{asset("/template/plugins/sparkline/jquery.sparkline.min.js")}}'></script>
<!-- jvectormap -->
<script src='{{asset("/template/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js")}}'></script>
<script src='{{asset("/template/plugins/jvectormap/jquery-jvectormap-world-mill-en.js")}}'></script>
<!-- SlimScroll 1.3.0 -->
<script src='{{asset("/template/plugins/slimScroll/jquery.slimscroll.min.js")}}'></script>
<!-- ChartJS 1.0.1 -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src='{{asset("/template/dist/js/pages/dashboard2.js")}}'></script>
<!-- AdminLTE for demo purposes -->
<script src='{{asset("/template/dist/js/demo.js")}}'></script>

<script src='{{asset("/template/plugins/datatables/jquery.dataTables.min.js")}}'></script>
<script src='{{asset("/template/plugins/datatables/dataTables.bootstrap.min.js")}}'></script>

 @if(Session::has('notify'))
 <script type="text/javascript">
 $(document).ready(function() {
    $.notify({
            message:'{{Session::get('notify')}}' ,
        },{
          animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
          },
            placement: {
              from: "bottom",
              align: "left"
            },
        });
    });
  </script>
 @endif

<script type="text/javascript">
  $(document).ready(function() {
    var url=window.location.href;
    $('.sidebar-menu li').each(function() {
      var href=$(this).find('a').attr('href');
      if(url.indexOf(href)!=-1 && href!=='http://'+window.location.host+'/admin')
      {
        $(this).addClass('active');
      }
    });
  });
</script>
@yield('script')

</body>
</html>
