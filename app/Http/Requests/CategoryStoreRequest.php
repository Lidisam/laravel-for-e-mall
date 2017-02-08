<?php

namespace App\Http\Requests;


class CategoryStoreRequest extends Request
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
            'cat_name.required' => '该名不能为空',
            'cat_name.unique' => '该名已存在',
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
            'cat_name' => 'required|unique:categorys,cat_name,' . $this->get('id') . '|max:255',
        ];
    }
}
