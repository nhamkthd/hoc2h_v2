@extends('admin.layouts.master')
@section('content')
<section class="content-header">
  <h1>
    Category
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Category</li>
  </ol>
</section>

<!-- list account -->
<section class="content" ng-app="hoc2h-role" ng-controller="role">
@include('admin.business.role.directives.modal_create')
@include('admin.business.role.directives.modal_edit')
@include('admin.business.role.directives.modal_delete')
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
              <th>ID</th>
              <th>Tiêu đề</th>
              <th>Quyền</th>
              <th>Mô tả</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody ng-init="listrole()">
            @verbatim
            <tr ng-repeat="r in list_roles">
              <td>{{r.id}}</td>
              <td>{{r.title}}</td>
              <td ng-if="r.level==1">super</td>
              <td ng-if="r.level==2">admin</td>
              <td ng-if="r.level==3">mode</td>
              <td ng-if="r.level==4">member </td>
              <td>{{r.discription}}</td>
              <td>         
               <div class="btn-group">
                  <a ng-click="edit(r.id,$index)"><i class="fa fa-fw fa-cog"></i></a>
                  <a ng-click="delete(r.id,$index)"><i class="fa fa-fw fa-remove"></i></a>
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