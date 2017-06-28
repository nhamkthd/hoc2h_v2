@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Đăng ký tài khoản
                    <a class="pull-right" href="{{ route('login') }}">Đăng nhập</a>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" name="regForm" method="POST" action="{{ route('register') }}" novalidate>
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="" class="col-md-4 control-label">Họ tên</label>
                            <div class="col-md-6">
                                <input class="form-control" name="name" required>
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
                                <button type="submit" class="btn btn-main">
                                   Đăng ký
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
