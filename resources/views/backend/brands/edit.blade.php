@extends('backend.layout.master')
@section('styles')
    <link rel="stylesheet" href="{{asset('/backend/dist/css/dropzone.css')}}">
@endsection
@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">ویرایش برند {{$brand->title}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        @include('backend.partials.form-errors')
                        <div class="form-group center-block">
                            <img src="{{$brand->photo->path}}" height="250px" class="center-block">
                        </div>
                        <form method="post" action="/admin/brands/{{$brand->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="form-group">
                                <label for="title">نام</label>
                                <input type="text" name="title" value="{{$brand->title}}" class="form-control" placeholder="نام برند را وارد کنید...">
                            </div>
                            <div class="form-group">
                                <label for="desc">توضیحات</label>
                                <textarea name="desc" class="form-control" placeholder="توضیحات را وارد کنید...">{{$brand->desc}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="img">تصویر</label>
                                <input type="hidden" name="photo_id" id="brand-photo" value="{{$brand->photo_id}}">
                                <div id="photo" class="dropzone"></div>
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
@section('scripts')
    <script src="{{asset('/backend/dist/js/dropzone.js')}}"></script>
    <script>
        var drop = new Dropzone('#photo',{
            addRemoveLinks:true,
            maxFiles:1,
            url:"{{route('photos.upload')}}",
            sending: function(file,xhr,formData){
                formData.append('_token','{{csrf_token()}}')
            },
            success: function (file , response) {
                document.getElementById('brand-photo').value = response.photo_id
            },
        });
    </script>
@endsection