  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('images/users/'.Auth::user()->avatar)}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="">
            <i class="fa fa-files-o"></i>
            <span>Quản lý Danh mục</span>
            <span class="pull-right-container">
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{asset('admin/category')}}"><i class="fa fa-list-alt"></i> Danh sách danh mục</a></li>
            <li><a href="{{asset('admin/category/create')}}"><i class="fa fa-plus-square"></i> Thêm danh mục</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="">
            <i class="fa fa-users"></i>
            <span>Quản lý người dùng</span>
            <span class="pull-right-container">
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{asset('admin/user')}}"><i class="fa fa-list-alt"></i> Danh sách người dùng</a></li>
            <li><a href="{{asset('admin/user/create')}}"><i class="fa fa-plus-square"></i> Thêm người dùng</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="">
            <i class="fa fa-users"></i>
            <span>Quản lý vai trò</span>
            <span class="pull-right-container">
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{asset('admin/role')}}"><i class="fa fa-list-alt"></i> Danh sách vai trò</a></li>
            <li><a href="{{asset('admin/role/create')}}"><i class="fa fa-plus-square"></i> Thêm vai trò</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>