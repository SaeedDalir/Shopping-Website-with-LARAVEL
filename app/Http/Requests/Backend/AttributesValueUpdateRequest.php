<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttributesValueUpdateRequest extends FormRequest
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
            'title'=>['required',Rule::unique('attributesvalue')->ignore($this->route('attributes_value'))],
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'لطفا نام مقدار ویژگی را وارد نمائید',
            'title.unique'=>'نام مقدار وارد شده قبلا ثبت شده است',
        ];
    }
}
