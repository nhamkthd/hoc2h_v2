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
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-8">
            <section class="form-elegant">
                <!--Form without header-->
                <form class="form-horizontal" name="regForm" method="POST" action="{{ route('register') }}" novalidate>
                        {{ csrf_field() }}
                    <div class="card">
                        <div class="card-body mx-4">
                            <!--Header-->
                            <div class="text-center">
                                <h3 class="dark-grey-text mb-5"><strong>Đăng Ký Tài Khoản</strong></h3>
                            </div>
                            <!--Body-->
                            <div class="md-form">
                                <input type="text" id="form-name" name="name" class="form-control" required>
                                <label for="Form-email1">Họ tên</label>
                            </div>
                            <div class="md-form">
                                <input type="text" id="form-user_name" name="user_name" class="form-control" required>
                                <label for="Form-email1">Tên đăng nhập</label>
                            </div>
                            <div class="md-form">
                                <input type="email" id="form-email" name="email" class="form-control" required>
                                <label for="Form-email1">Email</label>
                            </div>
                            <div class="md-form pb-3">
                                <input type="password" id="form-password" name="password" class="form-control" required>
                                <label for="Form-pass1">Mật khẩu</label>
                            </div>
                            <div class="md-form pb-3">
                                <input type="password" id="form-password-confirm" name="password_confirm" class="form-control" required>
                                <label for="Form-pass1">Xác nhận mật khẩu</label>
                            </div>
                            <div class="text-center mb-3">
                                <button type="submit" class="btn btn-block default-color">Đăng ký</button>
                            </div>
                        </div>

                        <!--Footer-->
                        <div class="modal-footer mx-5 pt-3 mb-1">
                            <p class="font-small grey-text d-flex justify-content-end">Đã là thành viên? <a href="{{ route('login') }}" class="blue-text ml-1"> Đăng nhập</a></p>
                        </div>

                    </div>
                </form>
                <!--/Form without header-->
            </section>
           
        </div>
    </div>
</div>
<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box" style="background-color: #fff;">
                <div class="form-heading">
                    <h4>Đăng ký tài khoản <a class="pull-right" href="{{ route('login') }}">Đăng nhập</a></h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" name="regForm" method="POST" action="{{ route('register') }}" novalidate>
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Họ tên</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" required>
                                @if ($errors->has('name'))
                                    <span class="help-block">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('user_name') ? ' has-error' : '' }}">
                            <label for="user_name" class="col-md-4 control-label">Tên đăng nhập</label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="user_name" ng-model="user_name" required >
                                @if ($errors->has('user_name'))
                                    <span class="help-block">{{ $errors->first('user_name') }}</span>
                                @endif       
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email</label>
                            <div class="col-md-6">
                                <input  type="email" class="form-control" name="email" required>
                                 @if ($errors->has('email'))
                                    <span class="help-block">{{ $errors->first('email') }}</span>
                                @endif                               
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Mật khẩu</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                                 @if ($errors->has('password'))
                                    <span class="help-block">{{ $errors->first('password') }}</span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Xác nhận mật khẩu</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input for="checkbox" type="checkbox" ng-model="accept">Đồng ý với điều khoản sử dụng.
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" ng-disabled="!accept">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-default">
                                   Đăng ký
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
