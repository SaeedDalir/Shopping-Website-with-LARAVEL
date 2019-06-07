@extends('frontend.layout.master')

@section('content')
    <div class="container">
        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
            <li><a href="index.html"><i class="fa fa-home"></i></a></li>
            <li><a href="cart.html">سبد خرید</a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-12">
                <h1 class="title">سبد خرید</h1>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td class="text-center">تصویر</td>
                            <td class="text-left">نام محصول</td>
                            <td class="text-left">کد محصول</td>
                            <td class="text-left">تعداد</td>
                            <td class="text-right">قیمت واحد</td>
                            <td class="text-right">کل</td>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($cart->items as $product)
                                <tr>
                                    <td class="text-center" width="10%"><a href="#"><img src="{{$product['item']->photos[0]->path}}" alt="تبلت ایسر" title="تبلت ایسر" class="img-thumbnail" /></a></td>
                                    <td class="text-left"><a href="#">{{$product['item']->title}}</a></td>
                                    <td class="text-left">{{$product['item']->sku}}</td>
                                    <td class="text-left">
                                        <div class="input-group btn-block quantity">
                                            <input type="text" disabled="disabled" name="quantity" value="{{$product['qty']}}" size="1" class="form-control" />
                                            <span class="input-group-btn">
                                                <a data-toggle="tooltip" title="اضافه" class="btn btn-primary" href="{{route('cart.add',['id' => $product['item']->id])}}"><i class="fa fa-plus"></i></a>
                                                <button type="button" data-toggle="tooltip" title="کم" class="btn btn-danger" onclick="event.preventDefault();
                                                        document.getElementById('remove-card-item-{{$product['item']->id}}').submit();"><i class="fa fa-minus"></i></button>
                                            </span>
                                            <form id="remove-card-item-{{$product['item']->id}}" action="{{ route('cart.remove',['id' => $product['item']->id]) }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </td>
                                    <td class="text-right">{{$product['item']->discount_price ? $product['item']->discount_price : $product['item']->price}} تومان</td>
                                    <td class="text-right">{{$product['price']}} تومان</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <h2 class="subtitle">حالا مایلید چه کاری انجام دهید؟</h2>
                <p>در صورتی که کد تخفیف در اختیار دارید میتوانید از آن در اینجا استفاده کنید.</p>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">استفاده از کوپن تخفیف</h4>
                            </div>
                            <div id="collapse-coupon" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <label class="col-sm-4 control-label" for="input-coupon">کد تخفیف خود را در اینجا وارد کنید</label>
                                    <div class="input-group">
                                        <input type="text" name="coupon" value="" placeholder="کد تخفیف خود را در اینجا وارد کنید" id="input-coupon" class="form-control" />
                                        <span class="input-group-btn">
                      <input type="button" value="اعمال کوپن" id="button-coupon" data-loading-text="بارگذاری ..."  class="btn btn-primary" />
                      </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    <div class="col-sm-6">--}}
{{--                        <div class="panel panel-default">--}}
{{--                            <div class="panel-heading">--}}
{{--                                <h4 class="panel-title">استفاده از کارت هدیه</h4>--}}
{{--                            </div>--}}
{{--                            <div id="collapse-voucher" class="panel-collapse collapse in">--}}
{{--                                <div class="panel-body">--}}
{{--                                    <label class="col-sm-4 control-label" for="input-voucher">کد کارت هدیه را در اینجا وارد کنید</label>--}}
{{--                                    <div class="input-group">--}}
{{--                                        <input type="text" name="voucher" value="" placeholder="کد کارت هدیه را در اینجا وارد کنید" id="input-voucher" class="form-control" />--}}
{{--                                        <span class="input-group-btn">--}}
{{--                      <input type="submit" value="اعمال کارت هدیه" id="button-voucher" data-loading-text="بارگذاری ..."  class="btn btn-primary" />--}}
{{--                      </span> </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-sm-6">
                        <table class="table table-bordered">
                            <tr>
                                <td class="text-right"><strong>جمع کل:</strong></td>
                                <td class="text-right">{{Session::get('cart')->totalPurePrice}} تومان</td>
                            </tr>
                            <tr>
                                <td class="text-right"><strong> تخفیف:</strong></td>
                                <td class="text-right">{{Session::get('cart')->totalDiscountPrice}} تومان</td>
                            </tr>
                            <tr>
                                <td class="text-right"><strong>کل :</strong></td>
                                <td class="text-right">{{Session::get('cart')->totalPrice}} تومان</td>
                            </tr>
                        </table>
                        <div class="pull-left"><a href="/" class="btn btn-default">ادامه خرید</a></div>
                        <div class="pull-right"><a href="{{route('order.verify')}}" class="btn btn-primary">تسویه حساب</a></div>
                    </div>
                </div>
            </div>
            <!--Middle Part End -->
        </div>
    </div>
@endsection