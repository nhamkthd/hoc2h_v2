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
        <li ng-class="{active:navbarSelected === 1}"><a ng-click="navBarTabClick(1)">Đề Thi <span class="sr-only">(current)</span></a></li>
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
            <li class="dropdown" id="showRight">
              <a href="#"><i class="fa fa-comment" aria-hidden="true"></i> Tin nhắn</a>
            </li>
            <li class="dropdown" ng-mouseover="readNotify(unReadNotification.length)">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="fa fa-globe" aria-hidden="true"></i> Thông báo <span class="badge notify-badge" ng-hide="unReadNotification.length == 0"> @verbatim {{unReadNotification.length}}  @endverbatim</span></a>
              <ul style=" max-height: 300px;overflow-y:scroll; " class="dropdown-menu">
                  @include('notifications.list_notify')
              </ul>
            </li>
         
              <li class="dropdown"  ng-init="initNotification()">
                <a href="#">
                  <img src="{{Auth::user()->avatar}}" width="30" height="30">
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

<div ng-app="hoc2h-message" ng-controller="MessageController">
  <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
    <h3>Tin nhắn
    <i class="fa fa-times pull-right icon-close" id="close_message_slide" aria-hidden="true"></i>
    </h3>
  </nav>
</div>

 <script src="{{asset('js/flugin/slide-menus/classie.js')}}"></script>
    <script>
      var menuRight = document.getElementById( 'cbp-spmenu-s2' ),
          close_message_slide =  document.getElementById( 'close_message_slide' ),
        body = document.body;

      showRight.onclick = function() {
        classie.toggle( this, 'active' );
        classie.toggle( menuRight, 'cbp-spmenu-open' );
      };

      close_message_slide.onclick = function() {
        classie.toggle( this, 'active' );
        classie.toggle( menuRight, 'cbp-spmenu-open' );
      };
    </script>