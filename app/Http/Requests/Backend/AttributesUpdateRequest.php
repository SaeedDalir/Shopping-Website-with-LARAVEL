<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttributesUpdateRequest extends FormRequest
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
            'title'=>['required',Rule::unique('attributesgroup')->ignore($this->route('attributes_group'))],
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'لطفا نام ویژگی را وارد نمائید',
            'title.unique'=>'نام وارد شده قبلا ثبت شده است',
        ];
    }
}
