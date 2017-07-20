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
<section class="content">
 <div class="row">
  <div class="col-sm-12">
    <div class="box">
      <div class="box-header col-sm-12">
        <div class="col-sm-2">
          <a href="{{url('admin/role/create')}}" class="btn btn-block btn-default">Create Role</a>
        </div>
      </div>
      <div class="col-sm-12">
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
              <th>ID</th>
              <th>Title</th>
              <th>promissions_id</th>
              <th>discription</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($role as $u)
            <tr>
              <td>{{$u->id}}</td>
              <td>{{$u->title}}</td>
              <td>{{$u->promissions_id}}</td>
              <td>{{$u->discription}}</td>
              <td>
                <div class="btn-group">
                  <a href="{{ asset('admin/role/show/'.$u->id) }}"><i class="fa fa-fw fa-cog"></i></a>
                  <a href="{{ asset('admin/role/'.$u->id) }}"><i class="fa fa-fw fa-remove"></i></a>
                </div>
              </td>
            </tr> 
            @endforeach   
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
@stop