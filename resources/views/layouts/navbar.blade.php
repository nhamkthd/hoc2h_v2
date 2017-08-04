<nav class="navbar navbar-default fixed-top"  ng-app="hoc2h-heading" ng-controller="HeadingController">
  @if(Route::has('login'))
    @if(Auth::check())
      <div ng-init="getUser({{Auth::user()}})"></div>
    @endif
  @endif
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header" ">
      <a class="navbar-brand" href="#">Hoc2H</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div >
      <ul class="nav navbar-nav">
        <li><a href="{{route('tests')}}">Đề Thi <span class="sr-only">(current)</span></a></li>
        <li><a href="{{url('/questions')}}">Hỏi Đáp </a></li>
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
            <li class="dropdown" ng-mouseover="readNotify(unReadNotification.length)">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"> Thông báo <span class="badge ng-binding"> @verbatim {{unReadNotification.length}}  @endverbatim</span></a>
              <ul style=" max-height: 300px;overflow-y:scroll; " class="dropdown-menu">
                  @include('notifications.list_notify')
              </ul>
            </li>
         
              <li class="dropdown"  ng-init="initNotification()">
                <a href="#">
                  @if(Auth::user()->provider_id)
                    <img src="{{Auth::user()->avatar}}" width="30" height="30">
                  @endif
                  {{Auth::user()->name}}<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('/users/'.Auth::user()->id.'/profile')}}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> trang cá nhân</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="fa fa-user-times" aria-hidden="true"></i> đăng xuất</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     {{ csrf_field() }}
                   </form>
                 </li>
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