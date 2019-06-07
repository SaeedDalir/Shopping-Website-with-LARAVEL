@extends('backend.layout.master')

@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">سفارشات</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        <div>{{session('error')}}</div>
                    </div>
                @endif
                @if(Session::has('products_store'))
                    <div class="alert alert-success">
                        <div>{{session('products_store')}}</div>
                    </div>
                @endif
                @if(Session::has('products_update'))
                    <div class="alert alert-success">
                        <div>{{session('products_update')}}</div>
                    </div>
                @endif
                @if(Session::has('products_delete'))
                    <div class="alert alert-success">
                        <div>{{session('products_delete')}}</div>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th class="text-center">شناسه</th>
                            <th class="text-center">مقدار</th>
                            <th class="text-center">وضعیت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td class="text-center">{{$order->id}}</td>
                                <th class="text-center">{{$order->amount}}</th>
                                <td class="text-center">
                                    @if($order->status == 1)
                                        <span class="label label-success">پرداخت شده</span>
                                    @else
                                        <span class="label label-danger">پرداخت نشده</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="col-md-12 text-md-center">{{$orders->links()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </section>
@endsection