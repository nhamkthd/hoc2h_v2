<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" ng-app="hoc2h-heading" ng-controller="HeadingController">
  @if(Route::has('login'))
    @if(Auth::check())
      <div ng-init="getUser({{Auth::user()}})"></div>
    @endif
  @endif
  <div ng-init="getCategories()"></div>
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="{{url('/home')}}" class="navbar-brand">Hoc2H</a>
    </div>
    <!-- Collection of nav links and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="#" ng-click="navBarTabClick(1)">Đề Thi</a></li>
        <li><a  href="{{url('/questions')}}">Hỏi Đáp</a></li>
        <li class="dropdown"><a href="#">Danh Mục <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li ng-repeat="category in parents_categories"><a href="#">@verbatim {{category.title}} @endverbatim</a></li>
            </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a  href="#"><i class="fa fa-search" aria-hidden="true"></i> tìm kiếm</a></li>
        @if(Route::has('login'))
          @if(Auth::check())
            <li class="dropdown" id="showRight">
              <a href="#"><i class="fa fa-circle user-status online" aria-hidden="true"></i> Online</a>
            </li>
            <li class="dropdown" ng-app="hoc2h-message" ng-controller="ReceiveMessageController" ng-init="user_id={{Auth::user()->id}}">
              <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i> Tin nhắn <span class="badge notify-badge"></span></a>
              <ul style="height: 70vh;overflow-y:auto;width: 40vw " class="dropdown-menu">
                @include('conversations.list')
              </ul>
            </li>
            <li class="dropdown" ng-mouseover="readNotify(unReadNotification.length)">
              <a href="#"><i class="fa fa-globe" aria-hidden="true"></i> Thông báo <span class="badge notify-badge" ng-hide="unReadNotification.length == 0"> 
              @verbatim {{unReadNotification.length}} @endverbatim</span></a>
              <ul style="height: 70vh;overflow-y:auto;width: 30vw " class="dropdown-menu">
                @include('notifications.list_notify')
              </ul>
            </li>
          <li class="dropdown"  ng-init="initNotification()">
            <a href="{{url('/users/'.Auth::user()->id.'/profile')}}">
              <img class="img-avt" src="{{Auth::user()->avatar}}">
              {{Auth::user()->name}}<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{url('/users/'.Auth::user()->id.'/profile')}}"><i class="fa fa-user-o" aria-hidden="true"></i> Trang cá nhân</a></li>
                <li role="separator" class="divider"></li>
                <li><a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> Đăng xuất</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                   {{ csrf_field() }}
                 </form>
               </li>
             </ul>
           </li>
           @else
            <li><a href="{{url('/login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> Đăng nhập</a></li>
            <li><a href="{{url('/register')}}"><i class="fa fa-unlock" aria-hidden="true"></i> Đăng ký</a></li>
           @endif
         @endif
       </ul>
     </div>
   </div>
 </nav>

 <div ng-app="hoc2h-message" ng-controller="MessageController">
  <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2" style="margin-top: 70px;">
    <h3>Online
    <i class="fa fa-times pull-right icon-close" id="close_message_slide" aria-hidden="true"></i>
    </h3>
    @verbatim
    <ul class="menu-list">  
      <li ng-repeat="user in listUserOnline" ng-click="add_msg(user.id)">
        <img src="{{user.avatar}}" class="is-circle is-outlined bg-white" width="64">
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