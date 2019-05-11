@if(isset($selected_category))
    @foreach($categories as $sub_category)
        <option value="{{$sub_category->id}}" @if($selected_category->parent_id == $sub_category->id) selected @endif class="text-sm">{{str_repeat('  -  -  ',$level)}} {{$sub_category->title}}</option>
        @if(count($sub_category->childrenRecursive) > 0)
            @include('backend.partials.category',['categories'=>$sub_category->childrenRecursive,'level'=>$level+1,'selected_category'=>$selected_category])
        @endif
    @endforeach
@else
    @foreach($categories as $sub_category)
        <option value="{{$sub_category->id}}" class="text-sm">{{str_repeat('  -  -  ',$level)}} {{$sub_category->title}}</option>
        @if(count($sub_category->childrenRecursive) > 0)
            @include('backend.partials.category',['categories'=>$sub_category->childrenRecursive,'level'=>$level+1])
        @endif
    @endforeach
@endif
