<?php

namespace App\Http\Requests\Front\Auth;

use App\Http\Requests\Request;

class RegisterRequest extends Request
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
            'mobile.required' => '手机不能为空',
            'mobile.unique' => '该手机已存在',
            'mobile.max' => '该手机格式不合法',
            'password.min' => '密码长度不能短少于6个字符',
            'password.max' => '密码长度不能多于255个字符',
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
            'mobile' => 'required|unique:users,mobile,' . $this->get('id') . '|max:11',
            'password' => 'min:6|max:255|confirmed',
        ];
    }
}
