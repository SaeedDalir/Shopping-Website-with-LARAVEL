@extends('backend.layout.master')

@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">اختصاص ویژگی به دسته بندی {{$category->title}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form method="post" action="/admin/categories/{{$category->id}}/settings">
                            @csrf
                            <div class="form-group">
                                <label>اختصاص ویژگی به دسته بندی {{$category->title}}</label>
                                <select name="attributeGroups[]" class="form-control">
                                    @foreach($attributeGroups as $attributeGroup)
                                        <option value="{{$attributeGroup->id}}" @if(in_array($attributeGroup->id,$category->attributeGroups->pluck('id')->toArray())) selected @endif class="text-bold text-green">{{$attributeGroup->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group pull-left">
                                <input type="submit" class="btn btn-success" value="ذخیره">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
@endsection