<?php

namespace App\Http\Requests;


class TypeUpdateRequest extends Request
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
            'type_name.required' => '该名不能为空',
            'type_name.unique' => '该名已存在',
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
            'type_name' => 'required|unique:types,type_name,' . $this->get('id') . '|max:255',
        ];
    }
}
