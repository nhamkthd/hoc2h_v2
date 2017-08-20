  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{Auth::user()->avatar}}" class="img-circle">
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
        <li class="treeview">
          <a href="{{ url('admin') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
       <li class="treeview">
        <a href="{{ url('admin/category') }}">
          <i class="fa fa-bars" aria-hidden="true"></i> <span>Quản lý danh mục</span>
          </a>
        </li>
        <li class="treeview">
        <a href="{{ url('admin/user') }}">
           <i class="fa fa-user" aria-hidden="true"></i> <span>Quản lý người dùng</span>
          </a>
        </li>
         <li class="treeview">
          <a href="{{ url('admin/role') }}">
            <i class="fa fa-users"></i> <span>Quản lý vai trò</span>
          </a>
        </li>
         <li class="treeview">
          <a href="{{ url('admin/tag') }}">
            <i class="fa fa-tag"></i> <span>Quản lý thẻ tag</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>