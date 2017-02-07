<?php

namespace App\Http\Requests;


class BrandStoreRequest extends Request
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
     * 自定义错误格式
     * @return array
     */
    public function messages()
    {
        return [
            'brand_name.required' => '品牌名不能为空',
            'brand_name.unique' => '该品牌名已存在',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'brand_name' => 'required|unique:brands,brand_name,' . $this->get('id') . '|max:255',
        ];
    }
}
