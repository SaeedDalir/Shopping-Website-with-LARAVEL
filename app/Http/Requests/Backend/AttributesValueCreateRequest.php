<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class AttributesValueCreateRequest extends FormRequest
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
            'title'=>'required|unique:attributesValue',
            'attribute_group'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'لطفا نام مقدار ویژگی را وارد نمائید',
            'title.unique'=>'نام مقدار وارد شده قبلا ثبت شده است',
            'attribute_group.required'=>'لطفا ویژگی مورد نظر را انتخاب نمائید',
        ];
    }
}
