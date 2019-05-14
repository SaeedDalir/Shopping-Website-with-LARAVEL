<?php

namespace App\Http\Requests\Backend;

use Dotenv\Exception\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class ProductCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    Protected function PrepareForValidation()
    {
        if ($this->slug){
            $this->merge(['slug' => make_slug($this->slug)]);
        }else{
            $this->merge(['slug' => make_slug($this->title)]);
        }
    }

    public function rules()
    {

        return [
            'title'=>'required',
            'slug'=> 'unique:products',
            'price'=> 'required',
            'desc'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'لطفا نام محصول را وارد نمائید',
            'slug.unique'=>'نام مستعار وارد شده قبلا ثبت شده است',
            'price.required'=>'لطفا قیمت محصول را وارد نمائید',
            'desc.required'=>'لطفا توضیحات محصول را وارد نمائید',
        ];
    }
}
