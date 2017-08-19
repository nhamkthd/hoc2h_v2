@extends('admin.layouts.master')
@section('content')
<section class="content-header">
  <h1>
    Quản lý vai trò người dùng
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Role</li>
  </ol>
</section>

<!-- list account -->
<section class="content" ng-app="hoc2h-role" ng-controller="role">
@include('admin.business.role.directives.modal_create')
@include('admin.business.role.directives.modal_edit')
@include('admin.business.role.directives.modal_delete')
@include('admin.business.role.directives.modal_warning')
 <div class="row">
  <div class="col-sm-12">
    <div class="box">
      <div class="box-header col-sm-12">
        <div class="col-sm-2">
          <a class="btn btn-block btn-default" ng-click="add()">Create Role</a>
        </div>
      </div>
      <div class="col-sm-12">
        @if(session('notify'))
        <div class="alert bg-teal disabled color-palette">
          {{session('notify')}}
        </div>
        @endif
      </div>
      <div class="box-body" >
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
          <thead>
            <tr></tr>
            <tr role="row">
              <th>Quyền</th>
              <th>Mô tả</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody ng-init="listrole()">
            @verbatim
            <tr ng-repeat="r in list_roles">
              <td>{{r.title}}</td>
              <td>{{r.discription}}</td>
              <td>         
               <div class="btn-group">
                  <a ng-click="edit(r.id,$index)" title="Sửa"><i class="fa fa-fw fa-cog"></i></a>
                  <a ng-click="delete(r.id,$index)" title="Xóa"><i class="fa fa-fw fa-remove"></i></a>
                  <a href="/admin/role/permission/{{r.id}}" title="Phân Quyền"><i class="fa fa-users" aria-hidden="true"></i></a>
                </div>
              </td>
            </tr> 
            @endverbatim
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
@stop