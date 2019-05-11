<?php

namespace App\Http\Controllers\Backend;

use App\AttributeGroup;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('childrenRecursive')
            ->where('parent_id',null)
            ->paginate(10);
        return view('backend.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with('childrenRecursive')
            ->where('parent_id',null)
            ->get();
        return view('backend.categories.create',compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categories = new Category();
        $categories->title = $request->input('title');
        $categories->parent_id = $request->input('category_parent');
        $categories->meta_title = $request->input('meta_title');
        $categories->meta_desc = $request->input('meta_desc');
        $categories->meta_keywords = $request->input('meta_keywords');
        $categories->save();

        return redirect('/admin/categories');
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
        $categories = Category::with('childrenRecursive')
            ->where('parent_id',null)
            ->get();
        $category = Category::findOrFail($id);
        return view('backend.categories.edit',compact(['categories','category']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->title = $request->input('title');
        $category->parent_id = $request->input('category_parent');
        $category->meta_title = $request->input('meta_title');
        $category->meta_desc = $request->input('meta_desc');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->save();

        return redirect('/admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::with('childrenRecursive')->where('id',$id)->first();
        if (count($category->childrenRecursive) > 0 ){
            Session::flash('error_category','دسته بندی  ' .$category->title. '  دارای زیر دسته می باشد ، لذا حذف آن امکان پذیر نمی باشد .');
            return redirect('/admin/categories');
        }
        $category->delete();

        return redirect('/admin/categories');
    }

    public function indexSetting($id)
    {
        $category = Category::findOrFail($id);
        $attributeGroups = AttributeGroup::all();
        return view('backend/categories/index-setting',compact(['category','attributeGroups']));
    }

    public function saveSetting(Request $request,$id)
    {
        $category = Category::findOrFail($id);
        $category->attributeGroups()->sync($request->attributeGroups);
        $category->save();

        return redirect('/admin/categories');
    }

    public function apiIndex()
    {
        $categories = Category::with('childrenRecursive')
            ->where('parent_id',null)
            ->get();
        $response = [
            'categories' => $categories
        ];
        return response()->json($response,200);
    }

    public function apiIndexAttribute(Request $request)
    {
        $categories = $request->all();
        $attributeGroup = AttributeGroup::with('attributesValue','categories')
            ->whereHas('categories',function ($q) use ($categories){
                $q->whereIn('categories.id',$categories);
            })->get();
        $response = [
            'attributes' => $attributeGroup
        ];
        return response()->json($response,200);
    }
}
