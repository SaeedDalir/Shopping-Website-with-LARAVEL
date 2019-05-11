<?php

namespace App\Http\Controllers\Backend;

use App\AttributeGroup;
use App\AttributeValue;
use App\Http\Requests\Backend\AttributesValueCreateRequest;
use App\Http\Requests\Backend\AttributesValueUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributesValue = AttributeValue::with('attributeGroup')->paginate(10);
        return view('backend.attributes-value.index',compact(['attributesValue']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributesGroup = AttributeGroup::all();
        return view('backend.attributes-value.create',compact(['attributesGroup']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributesValueCreateRequest $request)
    {
        $attributesValue = new AttributeValue();
        $attributesValue->title = $request->input('title');
        $attributesValue->attributeGroup_id = $request->input('attribute_group');
        $attributesValue->save();
        Session::flash('attributes_store','مقدار ویژگی جدید با موفقیت اضافه شد');

        return redirect('/admin/attributes-value');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attributeValue = AttributeValue::with('attributeGroup')->where('id',$id)->firstOrFail();
        $attributesGroup = AttributeGroup::all();
        return view('backend.attributes-value.edit',compact(['attributeValue','attributesGroup']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributesValueUpdateRequest $request, $id)
    {
        $attributeValue = AttributeValue::findOrFail($id);
        $attributeValue->title = $request->input('title');
        $attributeValue->attributeGroup_id = $request->input('attribute_group');
        $attributeValue->save();
        Session::flash('attributes_update','مقدار ویژگی ' .$attributeValue->title. ' با موفقیت بروزرسانی شد.');

        return redirect('/admin/attributes-value');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attributeValue = AttributeValue::findOrFail($id);
        $attributeValue->delete();

        Session::flash('attributes_delete','مقدار ویژگی ' .$attributeValue->title. ' حذف گردید.');

        return redirect('/admin/attributes-value');
    }
}
