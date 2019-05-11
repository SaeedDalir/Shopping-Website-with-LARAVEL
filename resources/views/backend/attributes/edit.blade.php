@extends('backend.layout.master')

@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">ویرایش گروه بندی ویژگی {{$attributeGroup->title}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        @include('backend.partials.form-errors')
                        <form method="post" action="/admin/attributes-group/{{$attributeGroup->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="form-group">
                                <label for="title">عنوان گروه بندی ویژگی</label>
                                <input type="text" name="title" value="{{$attributeGroup->title}}" class="form-control" placeholder="عنوان گروه بندی ویژگی را وارد کنید...">
                            </div>
                            <div class="form-group">
                                <label for="type">نوع</label>
                                <select name="type" class="form-control">
                                    <option value="select" @if($attributeGroup->type == "select") selected @endif>تکی</option>
                                    <option value="multiple" @if($attributeGroup->type == "multiple") selected @endif>چندتایی</option>
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