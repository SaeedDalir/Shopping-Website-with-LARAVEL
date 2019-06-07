@extends('frontend.layout.master')

@section('content')
    <div class="row">
        <!--Right Part Start -->
        <aside id="column-right" class="col-sm-3 hidden-xs">
            <h3 class="subtitle">حساب کاربری</h3>
            <div class="list-group">
                <ul class="list-item">
                    <li><a href="login.html">ورود</a></li>
                    <li><a href="register.html">ثبت نام</a></li>
                    <li><a href="#">فراموشی رمز عبور</a></li>
                    <li><a href="#">حساب کاربری</a></li>
                    <li><a href="#">لیست آدرس ها</a></li>
                    <li><a href="wishlist.html">لیست علاقه مندی</a></li>
                    <li><a href="#">تاریخچه سفارشات</a></li>
                    <li><a href="#">دانلود ها</a></li>
                    <li><a href="#">امتیازات خرید</a></li>
                    <li><a href="#">بازگشت</a></li>
                    <li><a href="#">تراکنش ها</a></li>
                    <li><a href="#">خبرنامه</a></li>
                    <li><a href="#">پرداخت های تکرار شونده</a></li>
                </ul>
            </div>
        </aside>
        <!--Right Part End -->
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <div>{{session('success')}}</div>
                </div>
            @endif
            @if(Session::has('unsuccess'))
                <div class="alert alert-danger">
                    <div>{{session('unsuccess')}}</div>
                </div>
            @endif
            <div class="alert alert-info">
                <p>{{Auth::user()->name . ' ' . Auth::user()->last_name}} به حساب کاربری خود خوش آمدید</p>
            </div>
        </div>

        <!--Middle Part End -->
    </div>
@endsection
