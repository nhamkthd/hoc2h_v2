@extends('admin.layouts.master')
@section('content')
<section class="content-header">
  <h1>
    Role 
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Role</li>
  </ol>
</section>

<section class="content">
 <div class="row">
  <div class="col-sm-12">
    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Create Role</h3>
        </div>
        <div class="panel-body">
        <div class="form">
        <form class="form-validate form-horizontal" action="{{ route('getcreateRole') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group ">
          <label class="control-label col-lg-2">Permisstion *</label>
             <div class="col-lg-8">
                <select name="permisstion" class="form-control">
                  <option value="" selected="selected">Permisstion</option>
                  @foreach($permisstion as $per)
                  <option value="{{$per->id}}" @if(old('permisstion')==$per->id) selected="selected" @endif >{{$per->id}}</option>
                  @endforeach
                </select>
                @if($errors->has('permisstion'))<p style="color: red;">{{$errors->first('permisstion')}}</p>@endif
            </div>
          </div>
          <div class="form-group">
          <label class="control-label col-lg-2">Title *</label>
            <div class="col-lg-8">
              <input type="text" name="title" class="form-control" placeholder="Tiêu đề">
              @if($errors->has('title'))<p style="color: red;">{{$errors->first('title')}}</p>@endif
            </div>
          </div>
          <div class="form-group ">
          <label class="control-label col-lg-2">Description*</label>
            <div class="col-lg-8">
              <input type="text" name="description" class="form-control" placeholder="Miêu tả">
              @if($errors->has('description'))<p style="color: red;">{{$errors->first('description')}}</p>@endif
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-offset-5 col-lg-8">
              <button type="submit" class="btn btn-default">Lưu</button>
              <button type="reset" class="btn btn-default">Thoát</button>
            </div>
          </div>
          </form>
        </div>
        </div>
      </div>
    </div>
  </div>
</section>
@stop