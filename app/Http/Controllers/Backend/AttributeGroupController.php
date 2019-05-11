<?php

namespace App\Http\Controllers\Backend;

use App\AttributeGroup;
use App\Http\Requests\Backend\AttributesCreateRequest;
use App\Http\Requests\Backend\AttributesUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AttributeGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributesGroup = AttributeGroup::paginate(10);
        return view('backend.attributes.index',compact(['attributesGroup']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributesCreateRequest $request)
    {
        $attributesGroup = new AttributeGroup();
        $attributesGroup->title = $request->input('title');
        $attributesGroup->type = $request->input('type');
        $attributesGroup->save();
        Session::flash('attributes_store','ویژگی جدید با موفقیت اضافه شد');

        return redirect('/admin/attributes-group');
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
        $attributeGroup = AttributeGroup::findOrFail($id);
        return view('backend.attributes.edit',compact(['attributeGroup']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributesUpdateRequest $request, $id)
    {
        $attributeGroup = AttributeGroup::findOrFail($id);
        $attributeGroup->title = $request->input('title');
        $attributeGroup->type = $request->input('type');
        $attributeGroup->save();
        Session::flash('attributes_update','ویژگی ' .$attributeGroup->title. ' با موفقیت بروزرسانی شد.');

        return redirect('/admin/attributes-group');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attributeGroup = AttributeGroup::findOrFail($id);
        $attributeGroup->delete();
        Session::flash('attributes_delete','ویژگی ' .$attributeGroup->title. ' حذف گردید.');

        return redirect('/admin/attributes-group');
    }
}
