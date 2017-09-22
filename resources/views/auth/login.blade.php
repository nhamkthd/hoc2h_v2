
@extends('layouts.app')
@section('content')
<style type="text/css">
    .form-elegant .font-small {
  font-size: 0.8rem; }

.form-elegant .z-depth-1a {
  -webkit-box-shadow: 0 2px 5px 0 rgba(55, 161, 255, 0.26), 0 4px 12px 0 rgba(121, 155, 254, 0.25);
  box-shadow: 0 2px 5px 0 rgba(55, 161, 255, 0.26), 0 4px 12px 0 rgba(121, 155, 254, 0.25); }

.form-elegant .z-depth-1-half,
.form-elegant .btn:hover {
  -webkit-box-shadow: 0 5px 11px 0 rgba(85, 182, 255, 0.28), 0 4px 15px 0 rgba(36, 133, 255, 0.15);
  box-shadow: 0 5px 11px 0 rgba(85, 182, 255, 0.28), 0 4px 15px 0 rgba(36, 133, 255, 0.15); }
.md-form label {font-weight: 400;}
                
</style>
<div class="container ">
    <div class="row justify-content-md-center">
        <div class="col-6">
            <section class="form-elegant">
                <!--Form without header-->
                <form role="form" method="POST" action="{{ route('login') }}" novalidate>
                     {{ csrf_field() }}
                    <div class="card">
                        <div class="card-body mx-4">
                            <!--Header-->
                            <div class="text-center">
                                <h3 class="dark-grey-text mb-5"><strong>Đăng Nhập</strong></h3>
                            </div>
                            <!--Body-->
                            <div class="md-form">
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus>
                                <label for="Form-email1">Email</label>
                                @if ($errors->has('email'))
                                    <span class="help-block">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="md-form pb-3">
                                <input id="password" type="password" class="form-control" name="password" require>
                                <label for="Form-pass1">Mật khẩu</label>
                                <p class="font-small blue-text d-flex justify-content-end">Quên <a href="{{ route('password.request') }}" class="blue-text ml-1"> mật khẩu?</a></p>
                            </div>

                            <div class="text-center mb-3">
                                <button type="submit" class="btn btn-block default-color">Đăng nhập</button>
                            </div>
                            <p class="font-small dark-grey-text text-right d-flex justify-content-center mb-3 pt-2"> hoặc đăng nhập bằng</p>

                            <div class="row my-3 d-flex justify-content-center">
                                    <!--Facebook-->
                                <button type="button" class="btn btn-white btn-rounded mr-md-3 z-depth-1a"><i class="fa fa-facebook blue-text text-center"></i></button>
                                    <!--Google +-->
                                <button type="button" class="btn btn-white btn-rounded z-depth-1a"><i class="fa fa-google-plus blue-text"></i></button>
                            </div>
                        </div>
                        <!--Footer-->
                        <div class="modal-footer mx-5 pt-3 mb-1">
                            <p class="font-small grey-text d-flex justify-content-end">Chưa là thành viên? <a href="{{ route('register') }}" class="blue-text ml-1"> Đăng ký</a></p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>  
<!-- <div class="container ">
    <div class="row ">
        <div class="ng-scope col-md-8 col-md-offset-2">
            <div class="box" style="background-color: #fff;">
                <div class="form-heading">
                    <h4>Đăng Nhập  
                        <a class="pull-right" href="{{ route('register') }}">Đăng ký</a></h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}" novalidate>
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email / Tên đăng nhập</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Mật khẩu</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>Ghi nhớ đăng nhập
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-top: 10px; font-size: 13px;">
                                 <a style="text-decoration:underline;" href="{{ route('password.request') }}">
                                    Quên mật khẩu?
                                </a> 
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4" style="padding:10px;">
                                <button type="submit" class="btn btn-default">
                                    Đăng nhập
                                </button>
                                 <a href="{{ url('redirect') }}" class="btn btn-indigo facebook-color pull-right">
                                   <i class="fa fa-facebook-square" aria-hidden="true"></i> Đăng nhập bằng facebook
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 -->
@endsection
