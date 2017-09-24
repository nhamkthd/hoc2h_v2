@extends('layouts.app')
@section('content')
<style type="text/css">
    .form-horizontal {padding: 20px;}
    .form-elegant .font-small {font-size: 0.8rem; padding: 20px; }
    .input-field label {font-weight: 400;}       
    .card-body {padding: 20px;}         
</style>
<div class="container">
    <div class="row ">
        <div class="col s8 offset-s2">
            <section class="form-elegant">
                <!--Form without header-->
                <form class="form-horizontal" name="regForm" method="POST" action="{{ route('register') }}" novalidate>
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-body">
                            <!--Header-->
                            <div class="text-center">
                                <h5 class="dark-grey-text mb-5"><strong>Đăng Ký Tài Khoản</strong></h5>
                            </div>
                            <!--Body-->
                            <div class="input-field">
                                <input type="text" id="form-name" name="name" class="form-control" required>
                                <label for="form-name">Họ tên</label>
                            </div>
                            <div class="input-field">
                                <input type="text" id="form-user_name" name="user_name" class="form-control" required>
                                <label for="font-user-name">Tên đăng nhập</label>
                            </div>
                            <div class="input-field">
                                <input type="email" id="form-email" name="email" class="form-control" required>
                                <label for="form-email">Email</label>
                            </div>
                            <div class="input-field">
                                <input type="password" id="form-password" name="password" class="form-control" required>
                                <label for="form-password">Mật khẩu</label>
                            </div>
                            <div class="input-field">
                                <input type="password" id="form-password-confirm" name="password_confirm" class="form-control" required>
                                <label for="form-password-confirm">Xác nhận mật khẩu</label>
                            </div>
                           
                        </div>
                         <div class="row">
                            <button type="submit" class="col s6 offset-s3 waves-effect waves-light btn">Đăng ký</button>
                        </div>
                        <!--Footer-->
                        <div class="modal-footer">
                            <p class="font-small text-right">Đã là thành viên? <a href="{{ route('login') }}" class="blue-text ml-1"> Đăng nhập</a></p>
                        </div>

                    </div>
                </form>
                <!--/Form without header-->
            </section>
           
        </div>
    </div>
</div>
@endsection
