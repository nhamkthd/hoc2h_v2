<nav class="navbar navbar-default fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Hoc2H</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div >
      <ul class="nav navbar-nav">
        <li><a href="{{url('tests/')}}">Đề Thi <span class="sr-only">(current)</span></a></li>
        <li><a href="{{url('questions/')}}">Hỏi Đáp </a></li>
        <li><a href="#">Tài liệu</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Danh Mục<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @if(Route::has('login'))
            @if(Auth::check())
              <li class="notification"><a href="#">Thông báo</a></li>
              <li class="dropdown">
                <a href="#">{{Auth::user()->user_name}} <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Trang cá nhân</a></li>
                  <li><a href="#">Hỏi đáp</a></li>
                  <li><a href="#">Lịch sử làm đề</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="#">Cài đặt tài khoản</a></li>
                  <li><a href="#">Cài Đặt thông báo</a></li>
                  <li><a href="{{route('logout') }}">Thoát</a></li>
                </ul>
              </li>
            @else
              <li><a href="{{url('/login')}}">Đăng nhập</a></li>
              <li><a href="{{url('/register')}}">Đăng ký</a></li>
            @endif
          @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>