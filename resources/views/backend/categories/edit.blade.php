@extends('backend.layout.master')

@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">ویرایش دسته بندی {{$category->title}}</h3>
            </div>--}}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form method="post" action="/admin/categories/{{$category->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="form-group">
                                <label for="title">عنوان</label>
                                <input type="text" name="title" value="{{$category->title}}" class="form-control" placeholder="عنوان دسته بندی را وارد کنید...">
                            </div>
                            <div class="form-group">
                                <label for="category_parent">دسته والد</label>
                                <select name="category_parent" class="form-control">
                                    <option value="">-- بدون والد --</option>
                                    @foreach($categories as $category_data)
                                        <option value="{{$category_data->id}}" @if($category_data->id == $category->parent_id) selected @endif class="text-bold text-green">{{$category_data->title}}</option>
                                        @if(count($category_data->childrenRecursive) > 0)
                                            @include('backend.partials.category',['categories'=>$category_data->childrenRecursive,'level'=>1,'selected_category'=>$category])
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="meta_title">عنوان سئو</label>
                                <input type="text" name="meta_title" value="{{$category->meta_title}}" class="form-control" placeholder="عنوان سئو را وارد کنید...">
                            </div>
                            <div class="form-group">
                                <label for="meta_desc">توضیحات سئو</label>
                                <textarea name="meta_desc" class="form-control" placeholder="توضیحات سئو را وارد کنید...">{{$category->meta_desc}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_keywords">کلمات کلیدی سئو</label>
                                <input type="text" name="meta_keywords" value="{{$category->meta_keywords}}" class="form-control" placeholder="کلمات کلیدی سئو را وارد کنید...">
                            </div>
                            <div class="form-group pull-left">
                                <input type="submit" class="btn btn-success" value="ذخیره تغییرات">
                            </div>
                        </form>
                    </div>
                </div>


            </div>
            <!-- /.box-body -->
        </div>
    </section>
@endsection