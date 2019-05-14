<?php

namespace App\Http\Controllers\Backend;

use App\Brand;
use App\Category;
use App\Http\Requests\Backend\ProductCreateRequest;
use App\Http\Requests\Backend\ProductUpdateRequest;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('backend.products.index',compact(['products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $categories = Category::with('childrenRecursive')
//            ->where('parent_id',null)
//            ->get();
        $brands = Brand::all();
        return view('backend.products.create',compact(['brands']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generateSKU()
    {
        $number = mt_rand(1000,200000);
        if ($this->checkSKU($number)){
            $this->generateSKU();
        }
        return (string)$number;
    }

    public function checkSKU($number)
    {
        return Product::where('sku',$number)->exists();
    }

    public function store(ProductCreateRequest $request)
    {
        $validator = Validator::make(
            [
                'categories' => $request->input('categories'),
                'attributes' => explode(',',$request->input('attributes')[0]),
                'photo_id' => explode(',',$request->input('photo_id')[0])

            ],
            [
                'categories' => 'required|array',
                'attributes' => 'required|array',
                'attributes.*' => 'required',
                'photo_id' => 'required|array',
                'photo_id.*' => 'required'
            ],
            [
                'categories.required'=>'لطفا دسته بندی محصول را انتخاب نمائید',
                'attributes.*.required'=>'لطفا ویژگی محصول را انتخاب نمائید',
                'photo_id.*.required'=>'لطفا تصویر محصول را بارگزاری نمائید'
            ]
        );
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        $newProduct = new Product();
        $newProduct->title = $request->title ;
        if ($request->slug){
            $newProduct->slug = make_slug($request->slug);
        }else{
            $newProduct->slug = make_slug($request->title);
        }
        $newProduct->sku = $this->generateSKU();
        $newProduct->status = $request->status;
        $newProduct->price = $request->price;
        $newProduct->discount_price = $request->discount_price;
        $newProduct->desc = $request->desc;
        $newProduct->brand_id = $request->brand;
        $newProduct->meta_slug = $request->meta_slug;
        $newProduct->meta_desc = $request->meta_desc;
        $newProduct->meta_keywords = $request->meta_keywords;
        $newProduct->user_id =1;
        $newProduct->save();

        $attributes = explode(',',$request->input('attributes')[0]);
        $photos = explode(',',$request->input('photo_id')[0]);

        $newProduct->categories()->sync($request->categories);
        $newProduct->attributeValues()->sync($attributes);
        $newProduct->photos()->sync($photos);
        Session::flash('products_store','محصول با موفقیت ایجاد شد');

        return redirect('/admin/products');
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
        $brands = Brand::all();
        $product = Product::with(['attributeValues','brand','categories','photos'])->whereId($id)->first();
        return view('backend.products.edit',compact(['brands','product']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $validator = Validator::make(
            [
                'categories' => $request->input('categories'),
                'attributes' => explode(',',$request->input('attributes')[0]),
                'photo_id' => explode(',',$request->input('photo_id')[0])

            ],
            [
                'categories' => 'required|array',
                'attributes' => 'required|array',
                'attributes.*' => 'required',
                'photo_id' => 'required|array',
                'photo_id.*' => 'required'
            ],
            [
                'categories.required'=>'لطفا دسته بندی محصول را انتخاب نمائید',
                'attributes.*.required'=>'لطفا ویژگی محصول را انتخاب نمائید',
                'photo_id.*.required'=>'لطفا تصویر محصول را بارگزاری نمائید'
            ]
        );
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        $product = Product::findOrFail($id);
        $product->title = $request->title ;
        if ($request->slug){
            $product->slug = make_slug($request->slug);
        }else{
            $product->slug = make_slug($request->title);
        }
        $product->sku = $this->generateSKU();
        $product->status = $request->status;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->desc = $request->desc;
        $product->brand_id = $request->brand;
        $product->meta_slug = $request->meta_slug;
        $product->meta_desc = $request->meta_desc;
        $product->meta_keywords = $request->meta_keywords;
        $product->user_id =1;
        $product->save();

        $attributes = explode(',',$request->input('attributes')[0]);
        $photos = explode(',',$request->input('photo_id')[0]);

        $product->categories()->sync($request->categories);
        $product->attributeValues()->sync($attributes);
        $product->photos()->sync($photos);
        Session::flash('products_update','محصول با موفقیت بروزرسانی شد');

        return redirect('/admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        Session::flash('products_delete','محصول با موفقیت حذف شد');

        return redirect('/admin/products');
    }
}
