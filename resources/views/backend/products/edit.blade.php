@extends('backend.layout.master')
@section('styles')
    <link rel="stylesheet" href="{{asset('/backend/dist/css/dropzone.css')}}">
@endsection
@section('content')
    <section class="content" id="app">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">ویرایش محصول {{$product->title}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        @include('backend.partials.form-errors')
                        <form method="post" action="/admin/products/{{$product->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="form-group">
                                <label for="title">نام</label>
                                <input type="text" name="title" value="{{$product->title}}" class="form-control" placeholder="نام محصول را وارد کنید...">
                            </div>
                            <div class="form-group">
                                <label for="slug">نام مستعار</label>
                                <input type="text" name="slug" value="{{$product->slug}}" class="form-control" placeholder="نام مستعار محصول را وارد کنید...">
                            </div>
                            <attribute-component :brands="{{ $brands }}" :product="{{ $product }}" ></attribute-component>
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <div>
                                    <input type="radio" name="status" value="0" @if($product->status == 0) checked  @endif><span>منتشر نشده</span>
                                    <input type="radio" name="status" value="1" @if($product->status == 1) checked  @endif><span>منتشر شده</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="price">قیمت</label>
                                <input type="number" name="price" value="{{$product->price}}" class="form-control" placeholder="قیمت محصول را وارد کنید...">
                            </div>
                            <div class="form-group">
                                <label for="discount_price">قیمت ویژه</label>
                                <input type="number" name="discount_price" value="{{$product->discount_price}}" class="form-control" placeholder="قیمت ویژه محصول را وارد کنید...">
                            </div>
                            <div class="form-group">
                                <label for="desc">توضیحات</label>
                                <textarea id="description" name="desc" class="ckeditor form-control" placeholder="توضیحات محصول را وارد کنید...">{{$product->desc}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="img">گالری تصاویر</label>
                                <input type="hidden" name="photo_id[]" id="product-photo">
                                <div id="photo" class="dropzone"></div>
                                <hr>
                                <div class="row">
                                    @foreach($product->photos as $photo)
                                        <div class="col-sm-3" id="updated_photo_{{$photo->id}}">
                                            <img class="img-responsive" src="{{$photo->path}}">
                                            <button style="margin-top: 5px" type="button" class="btn btn-danger center-block" onclick="removeImages({{$photo->id}})"><i class="glyphicon glyphicon-remove"></i></button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="meta_slug">عنوان سئو</label>
                                <input type="text" name="meta_slug" value="{{$product->meta_slug}}" class="form-control" placeholder="عنوان سئو محصول را وارد کنید...">
                            </div>
                            <div class="form-group">
                                <label for="meta_desc">توضیحات سئو</label>
                                <textarea name="meta_desc" class="form-control" placeholder="توضیحات سئو محصول را وارد کنید...">{{$product->meta_desc}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_keywords">کلمات کلیدی سئو</label>
                                <input type="text" name="meta_keywords" value="{{$product->meta_keywords}}" class="form-control" placeholder="کلمات کلیدی سئو محصول را وارد کنید...">
                            </div>
                            <div class="form-group pull-left">
                                <input type="submit" onclick="productGallery()" class="btn btn-success" value="ذخیره">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
@endsection
@section('script-vuejs')
    <script src="{{asset('/backend/js/app.js')}}"></script>
@endsection
@section('scripts')
    <script src="{{asset('/backend/dist/js/dropzone.js')}}"></script>
    <script src="{{asset('/backend/plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        Dropzone.autoDiscover = false;
        var photosGallery = []
        var photos = [].concat({{$product->photos->pluck('id')}})
        var drop = new Dropzone('#photo',{
            addRemoveLinks:true,
            url:"{{route('photos.upload')}}",
            sending: function(file,xhr,formData){
                formData.append('_token','{{csrf_token()}}')
            },
            success: function (file , response) {
                photosGallery.push(response.photo_id)
            },
        });
        productGallery = function(){
            document.getElementById('product-photo').value = photosGallery.concat(photos)
        }
        CKEDITOR.replace('description',{
            language: 'fa',
            customConfig: 'config.js',
            toolbar: 'simple'
        })
        removeImages = function (id) {
            var index = photos.indexOf(id)
            photos.splice(index,1);
            document.getElementById('updated_photo_' + id).remove();
        }
    </script>
@endsection