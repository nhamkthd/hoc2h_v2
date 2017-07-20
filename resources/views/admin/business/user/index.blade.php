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
          <a  href="{{url('admin/user/create')}}" class="btn btn-block btn-default">Tạo mới người dùng</a>
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
              <th>ID</th>
              <th>Roles</th>
              <th>User Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Class</th>
              <th>Gender</th>
              <th>Status</th>
              <th>Birthday</th>
              <th>Avatar</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($user as $u)
            <tr>
              <td>{{$u->id}}</td>
              <td>{{$u->role->title}}</td>
              <td>{{$u->name}}</td>
              <td>{{$u->email}}</td>
              <td>{{$u->phone}}</td>
              <td>{{$u->class}}</td>
              <td>
                @if($u->gender==1)
                Nam
                @else 
                Nữ
                @endif</td>
                <td>
                  @if($u->status==1)
                  Kích hoạt
                  @else 
                  Không kích hoạt
                  @endif
                </td>
                <td>{{$u->birthday}}</td>
                <td>
                  <img width="120px" height="80px" src="{{asset('images/users/'.$u->avatar)}}">
                </td>
                <td>
                  <div class="btn-group">
                    <a href="{{ asset('admin/user/show/'.$u->id) }}"><i class="fa fa-fw fa-cog"></i></a>
                    <a href="{{ asset('admin/user/'.$u->id) }}"><i class="fa fa-fw fa-remove"></i></a>
                  </div>
                </td>
              </tr> 
              @endforeach   
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
@stop