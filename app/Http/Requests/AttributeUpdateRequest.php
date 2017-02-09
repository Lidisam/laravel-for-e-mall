<?php

namespace App\Http\Requests;


class AttributeUpdateRequest extends Request
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
            'attr_name.required' => '该名不能为空',
            'attr_name.max' => '该名超出长度限制',
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
            'attr_name' => 'required|max:30',
        ];
    }
}
