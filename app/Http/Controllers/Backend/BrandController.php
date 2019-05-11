<?php

namespace App\Http\Controllers\Backend;

use App\Brand;
use App\Http\Requests\Backend\BrandCreateRequest;
use App\Http\Requests\Backend\BrandUpdateRequest;
use App\Photo;
use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::paginate(10);
        return view('backend.brands.index',compact(['brands']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandCreateRequest $request)
    {
        $brand = new Brand();
        $brand->title = $request->input('title');
        $brand->desc = $request->input('desc');
        $brand->photo_id = $request->input('photo_id');
        $brand->save();
        Session::flash('brands_store','برند با موفقیت ایجاد شد');

        return redirect('/admin/brands');
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
        $brand = Brand::with('photo')->whereId($id)->first();
        return view('backend.brands.edit',compact(['brand']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandUpdateRequest $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->title = $request->input('title');
        $brand->desc = $request->input('desc');
        $brand->photo_id = $request->input('photo_id');
        $brand->save();
        Session::flash('brands_update','برند  ' .$brand->title. '  با موفقیت بروزرسانی شد.');

        return redirect('/admin/brands');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        if($photo = Photo::findOrFail($brand->photo_id)){
            unlink(public_path(). $photo->path);
            $photo->delete();
        }
        $brand->delete();
        Session::flash('brands_delete','برند  ' .$brand->title. '  حذف شد.');

        return redirect('/admin/brands');
    }
}
