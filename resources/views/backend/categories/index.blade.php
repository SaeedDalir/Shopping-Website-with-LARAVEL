@extends('backend.layout.master')

@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">دسته بندی ها</h3>
                <div class="pull-left">
                    <a class="btn btn-app" href="{{route('categories.create')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(Session::has('error_category'))
                    <div class="alert alert-danger">
                        <div>{{session('error_category')}}</div>
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
                        @foreach($categories as $category)
                            <tr>
                                <td class="text-center">{{$category->id}}</td>
                                <td class="text-bold text-green">{{$category->title}}</td>
                                <td class="text-center">
                                    <a class="btn btn-warning" href="{{route('categories.edit',$category->id)}}">ویرایش</a>
                                    <div class="display-inline-block">
                                        <form method="post" action="/admin/categories/{{$category->id}}">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger">حذف</button>
                                        </form>
                                    </div>
                                    <a class="btn btn-info" href="{{route('categories.indexSetting',$category->id)}}">اختصاص ویژگی ها</a>
                                </td>
                            </tr>
                            @if(count($category->childrenRecursive) > 0)
                                @include('backend.partials.category_list',['categories'=>$category->childrenRecursive,'level'=>1])
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </section>
@endsection