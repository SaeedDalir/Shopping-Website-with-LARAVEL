@extends('backend.layout.master')

@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">ویرایش مقدار ویژگی {{$attributeValue->title}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        @include('backend.partials.form-errors')
                        <form method="post" action="/admin/attributes-value/{{$attributeValue->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="form-group">
                                <label for="title">مقدار ویژگی</label>
                                <input type="text" name="title" value="{{$attributeValue->title}}" class="form-control" placeholder="مقدار ویژگی را وارد کنید...">
                            </div>
                            <div class="form-group">
                                <label for="attribute_group">ویژگی</label>
                                <select name="attribute_group" class="form-control">
                                    @foreach($attributesGroup as $attribute)
                                        <option value="{{$attribute->id}}" @if($attributeValue->attributeGroup->id == $attribute->id) selected @endif>{{$attribute->title}}</option>
                                    @endforeach
                                </select>
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