@extends('backend.layout.master')

@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">برند ها</h3>
                <div class="pull-left">
                    <a class="btn btn-app" href="{{route('brands.create')}}">
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
                @if(Session::has('brands_store'))
                    <div class="alert alert-success">
                        <div>{{session('brands_store')}}</div>
                    </div>
                @endif
                @if(Session::has('brands_update'))
                    <div class="alert alert-success">
                        <div>{{session('brands_update')}}</div>
                    </div>
                @endif
                @if(Session::has('brands_delete'))
                    <div class="alert alert-success">
                        <div>{{session('brands_delete')}}</div>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th class="text-center">شناسه</th>
                            <th>عنوان</th>
                            <th class="text-center">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($brands as $brand)
                            <tr>
                                <td class="text-center">{{$brand->id}}</td>
                                <td class="text-bold text-green">{{$brand->title}}</td>
                                <td class="text-center">
                                    <a class="btn btn-warning" href="{{route('brands.edit',$brand->id)}}">ویرایش</a>
                                    <div class="display-inline-block">
                                        <form method="post" action="/admin/brands/{{$brand->id}}">
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
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </section>
@endsection