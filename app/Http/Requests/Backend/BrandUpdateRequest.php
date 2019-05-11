<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class BrandUpdateRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title'=>'required|unique:brands,title,'.(request()->brand),
            'desc'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'لطفا نام برند را وارد نمائید',
            'title.unique'=>'نام وارد شده قبلا ثبت شده است',
            'desc.required'=>'لطفا توضیحات برند را وارد نمائید',
        ];
    }
}
