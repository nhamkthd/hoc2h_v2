@extends('admin.layouts.master')
@section('content')
<section class="content-header">
  <h1>
    Category
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">User</li>
  </ol>
</section>
<!-- list account -->
<section class="content" ng-app="hoc2h-user" ng-controller="userController">
 <div class="row">
  <div class="col-sm-12">
    <div class="box">
      <div class="box-header col-sm-12">
        <div class="col-sm-2">
          <a  href="{{url('admin/user/create')}}" class="btn btn-block btn-default">Tạo mới người dùng</a>
        </div>
         <div class="col-sm-2 pull-right">
          <input type="text" class="form-control" ng-keyup="onsearch(search)" placeholder="search" ng-model='search'>
        </div>
      </div>
      <div>
        @if(session('notify'))
        <div class="alert bg-teal disabled color-palette">
          {{session('notify')}}
        </div>
        @endif
      </div> 
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
          <thead>
            <tr></tr>
            <tr role="row">
              <th></th>
              <th>Roles</th>
              <th>User Name</th>
              <th>Email</th>
              <th>login with</th>
              <th>Gender</th>
              <th>Status</th>
              <th>Birthday</th>
              <th>Avatar</th>
              <th>Action</th>
            </tr>
          </thead>
          @verbatim
          <tbody ng-init="list_user()">
            <tr ng-repeat="u in list_users|orderBy:'-id'">
              <td><input type="checkbox" id="check1" ng-true-value="{{u.id}}" ng-false-value="''" ng-model="u.selected" /></td>
              <td>{{u.role.title}}</td>
              <td>{{u.name}}</td>
              <td>{{u.email}}</td>
              <td ng-if="u.provider==null">register</td>
              <td ng-if="u.provider=='facebook'">facebook</td>
              <td ng-if="u.gender==1">Nam</td>
              <td ng-if="u.gender!=1">Nữ</td>
              <td ng-if="u.status==1">Kích hoạt</td>
              <td ng-if="u.status==0">Không kích hoạt</td>
              <td>{{u.birthday}}</td>
                <td>
                  <img width="50" height="50" src="{{u.avatar}}">
                </td>
                <td>
                  <div class="btn-group">
                    <a href="user/show/{{u.id}}"><i class="fa fa-fw fa-cog"></i></a>
                    <a href="user/{{u.id}}"><i class="fa fa-fw fa-remove"></i></a>
                  </div>
                </td>
              </tr> 
            </tbody>
             @endverbatim
          </table> 
          <div class="row">
            <div class="col-md-2">
              <button class="btn btn-default" ng-click="deleteMulti(list_users)">Xóa mục đã chọn</button>
            </div>
            <div class="col-md-10">
              <posts-pagination class="pull-right"></posts-pagination>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@stop