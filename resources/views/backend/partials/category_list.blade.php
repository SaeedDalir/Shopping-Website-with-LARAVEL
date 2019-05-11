@foreach($categories as $sub_category)
    <tr>
        <td class="text-center">{{$sub_category->id}}</td>
        <td class="text-sm">{{str_repeat("  -  -  ",$level)}} {{$sub_category->title}}</td>
        <td class="text-center">
            <a class="btn btn-warning" href="{{route('categories.edit',$sub_category->id)}}">ویرایش</a>
            <div class="display-inline-block">
                <form method="post" action="/admin/categories/{{$sub_category->id}}">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">حذف</button>
                </form>
            </div>
            <a class="btn btn-info" href="{{route('categories.indexSetting',$sub_category->id)}}">اختصاص ویژگی ها</a>
        </td>
    </tr>
    @if(count($sub_category->childrenRecursive) > 0)
        @include('backend.partials.category_list',['categories'=>$sub_category->childrenRecursive,'level'=>$level+1])
    @endif
@endforeach