@extends('backend.layout.master')

@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">محصولات</h3>
                <div class="pull-left">
                    <a class="btn btn-app" href="{{route('products.create')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>
                </div>
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
                            <th class="text-center">کد محصول</th>
                            <th>عنوان</th>
                            <th class="text-center">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td class="text-center">{{$product->id}}</td>
                                <th class="text-center">{{$product->sku}}</th>
                                <td class="text-bold text-green">{{$product->title}}</td>
                                <td class="text-center">
                                    <a class="btn btn-warning" href="{{route('products.edit',$product->id)}}">ویرایش</a>
                                    <div class="display-inline-block">
                                        <form method="post" action="/admin/products/{{$product->id}}">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger">حذف</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="col-md-12 text-md-center">{{$products->links()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </section>
@endsection