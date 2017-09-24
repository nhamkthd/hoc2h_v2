 <nav>
    <div class="navbar-fixed  teal darken-2" ng-app="hoc2h-heading" ng-controller="HeadingController">
      @if(Route::has('login'))
        @if(Auth::check())
          <div ng-init="getUser({{Auth::user()}})"></div>
        @endif
      @endif
      <div ng-init="getCategories()"></div>
      <a href="{{url('/home')}}" class="brand-logo center">Hoc2H</a>
      <ul class="left hide-on-med-and-down">
        <li><a ng-click="navBarTabClick(1)">Đề Thi</a></li>
        <li><a href="{{url('/questions')}}">Hỏi Đáp</a></li>
        <li><a class="dropdown-button" data-activates="dropdown2" >Danh Mục<i class="material-icons right">arrow_drop_down</i></a>
            <ul id="dropdown2" class="dropdown-content">
              <li><a ng-repeat="category in parents_categories" href="#">@verbatim {{category.title}} @endverbatim</a></li>
            </ul>
        </li>
      </ul>
      <ul class="right hide-on-med-and-down">
        <li id="showRight"><a>Online</a></li>
         @if(Route::has('login'))
            @if(Auth::check())
              <li><a class="dropdown-button" data-activates="dropdown4">
                    <i class="fa fa-globe" aria-hidden="true"></i> Thông Báo</a>
                  <ul id="dropdown4" class="dropdown-content">
                    <li><a>notification content</a></li>
                  </ul>
              </li>
              <li ng-app="hoc2h-message" ng-controller="ReceiveMessageController" ng-init="user_id={{Auth::user()->id}}">
                <a class="dropdown-button"  data-activates="dropdown3">
                  <i class="fa fa-envelope-o" aria-hidden="true"></i> Tin Nhắn</a>
                <ul id="dropdown3" class="dropdown-content">
                  <li><a>message content</a></li>
                </ul>
              </li>
              @verbatim
              <li><a class="dropdown-button" data-activates="dropdown1" ><i class="fa fa-user-circle-o" aria-hidden="true"></i> {{user.name}}</a>
              @endverbatim
                  <ul id="dropdown1" class="dropdown-content">
                    <li><a href="{{url('/users/'.Auth::user()->id.'/profile')}}"><i class="fa fa-user-o" aria-hidden="true"></i> Trang cá nhân</a></li>
                    <li> <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> Đăng xuất</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                         {{ csrf_field() }}
                       </form>
                    </li>
                  </ul>
              </li>
            @else
              <li><a class="dropdown-button" href="{{url('/login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> Đăng Nhập</a></li>
              <li><a class="dropdown-button" href="{{url('/register')}}"><i class="fa fa-unlock" aria-hidden="true"></i> Đăng ký</a></li>
            @endif
          @endif
      </ul>
    </div>
  </nav>
 
 {{-- <nav class="navbar fixed-top navbar-expand-lg navbar-dark info-color-dark" ng-app="hoc2h-heading" ng-controller="HeadingController">
    @if(Route::has('login'))
      @if(Auth::check())
       <div ng-init="getUser({{Auth::user()}})"></div>
      @endif
    @endif
    <div ng-init="getCategories()"></div>
    <a class="navbar-brand" href="{{url('/home')}}">Hoc2H</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-5">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" ng-click="navBarTabClick(1)">Đề Thi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/questions')}}">Hỏi Đáp</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" 
            id="navbarDropdownMenuLink-Categories" 
            data-toggle="dropdown" 
            aria-haspopup="true" 
            aria-expanded="false">Danh Mục 
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink-Categories">
            <a class="dropdown-item" ng-repeat="category in parents_categories" href="#">@verbatim {{category.title}} @endverbatim</a>
          </div>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto nav-flex-icons">
         <li class="nav-item" id="showRight">
            <a class="nav-link waves-effect waves-light">Online</i></a>
          </li>
         @if(Route::has('login'))
            @if(Auth::check())
              <li class="nav-item" ng-app="hoc2h-message" ng-controller="ReceiveMessageController" ng-init="user_id={{Auth::user()->id}}">
                <a class="nav-link "  id="navbarDropdownMenuLink-Messages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-envelope"></i>Tin nhắn</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink-Messages">
                    Messags
                </div>
              </li>
              <li class="nav-item" ng-app="hoc2h-message" ng-controller="ReceiveMessageController" ng-init="user_id={{Auth::user()->id}}">
                <a class="nav-link "  id="navbarDropdownMenuLink-Notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-globe" aria-hidden="true"></i> Thông báo</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink-Notifications">
                  Notifications
                </div>
              </li>
              <li class="nav-item avatar dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-User" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  @verbatim
                  <img src="{{user.avatar}}" width="30" height="30" class="img-fluid rounded-circle z-depth-0">{{user.name}}</a>
                  @endverbatim
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink-User">
                    <a class="dropdown-item" href="{{url('/users/'.Auth::user()->id.'/profile')}}"><i class="fa fa-user-o" aria-hidden="true"></i> Trang cá nhân</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> Đăng xuất</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                   {{ csrf_field() }}
                 </form>
                  </div>
              </li>
            @else
            <li class="nav-item"><a class="nav-link" href="{{url('/login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i>Đăng Nhập</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/register')}}"><i class="fa fa-unlock" aria-hidden="true"></i> Đăng ký</a></li>
            @endif
          @endif
      </ul>
    </div>
</nav> --}}

 <div ng-app="hoc2h-message" ng-controller="MessageController">
  <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2" style="margin-top: 70px;">
    <h3>Online
    <i class="fa fa-times pull-right icon-close" id="close_message_slide" aria-hidden="true"></i>
    </h3>
    @verbatim
    <ul class="menu-list">  
      <li ng-repeat="user in listUserOnline" ng-click="add_msg(user.id)">
        <img src="{{user.avatar}}" class="is-circle is-outlined bg-white" width="35">
        {{user.name}} <i class="fa fa-circle user-status online" aria-hidden="true"></i>
      </li>
    </ul>
   @endverbatim
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