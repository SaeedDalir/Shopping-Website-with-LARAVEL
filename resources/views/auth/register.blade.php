@extends('frontend.layout.master')

@section('content')
    <div class="container">
        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
            <li><a href="/"><i class="fa fa-home"></i></a></li>
            <li><a href="#">حساب کاربری</a></li>
            <li><a href="{{route('register')}}">ثبت نام</a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
            <!--Middle Part Start-->
            <div class="col-sm-9" id="content">
                <h1 class="title">ثبت نام حساب کاربری</h1>
                <p>اگر قبلا حساب کاربریتان را ایجاد کرد اید جهت ورود به <a href="{{route('login')}}">صفحه لاگین</a> مراجعه کنید.</p>
                <form method="POST" action="{{ route('user.register') }}" class="form-horizontal">
                    @csrf
                    <fieldset id="account">
                        <legend>اطلاعات شخصی شما</legend>
                        <div class="form-group required">
                            <label for="input-firstname" class="col-sm-2 control-label">نام</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-firstname" placeholder="نام" value="" name="name">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="input-lastname" class="col-sm-2 control-label">نام خانوادگی</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-lastname" placeholder="نام خانوادگی" value="" name="last_name">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="input-email" class="col-sm-2 control-label">آدرس ایمیل</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="input-email" placeholder="آدرس ایمیل" value="" name="email">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="input-telephone" class="col-sm-2 control-label">شماره تلفن</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" id="input-telephone" placeholder="شماره تلفن" value="" name="phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-fax" class="col-sm-2 control-label">کدملی</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-fax" placeholder="کد ملی" value="" name="national_code">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset id="address">
                        <legend>آدرس</legend>
                        <div class="form-group">
                            <label for="input-company" class="col-sm-2 control-label">شرکت</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-company" placeholder="شرکت" value="" name="company">
                            </div>
                        </div>
                        <select-city-component></select-city-component>
                        <div class="form-group required">
                            <label for="input-address-1" class="col-sm-2 control-label">آدرس</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-address-1" placeholder="آدرس" value="" name="address">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="input-postcode" class="col-sm-2 control-label">کد پستی</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-postcode" placeholder="کد پستی" value="" name="post_code">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>رمز عبور شما</legend>
                        <div class="form-group required">
                            <label for="input-password" class="col-sm-2 control-label">رمز عبور</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="input-password" placeholder="رمز عبور" value="" name="password">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="input-confirm" class="col-sm-2 control-label">تکرار رمز عبور</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="input-confirm" placeholder="تکرار رمز عبور" value="" name="confirm">
                            </div>
                        </div>
                    </fieldset>
                    <div class="buttons">
                        <div class="pull-right">
                            <input type="submit" class="btn btn-primary" value="ثبت نام">
                        </div>
                    </div>
                </form>
            </div>
            <!--Middle Part End -->
        </div>
    </div>
@endsection
@section('script-vuejs')
    <script src="{{asset('/backend/js/app.js')}}"></script>
@endsection

