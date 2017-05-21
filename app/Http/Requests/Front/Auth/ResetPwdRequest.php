<?php

namespace App\Http\Requests\Front\Auth;

use App\Http\Requests\Request;

class ResetPwdRequest extends Request
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
            'old_password.min' => '旧密码长度不能短少于6个字符',
            'old_password.max' => '旧密码长度不能多于255个字符',
            'old_password.required' => '旧密码长度不能为空',
            'new_password.min' => '新密码长度不能短少于6个字符',
            'new_password.max' => '新密码长度不能多于255个字符',
            'new_password.required' => '新密码长度不能为空',
            'new_password.confirmed' => '新密码两次输入不一致',
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
            'old_password' => 'required|min:6|max:255',
            'new_password' => 'required|min:6|max:255|confirmed',
        ];
    }
}
