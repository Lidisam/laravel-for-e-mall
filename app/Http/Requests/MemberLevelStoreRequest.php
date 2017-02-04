<?php

namespace App\Http\Requests;


class MemberLevelStoreRequest extends Request
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
            'level_name.required' => '会员等级名不能为空',
            'level_name.unique' => '该会员等级名已存在',
            'rate.required' => '折扣率不能为空',
            'rate.min' => '折扣率不能为负',
            'rate.max' => '折扣率不能大于100',
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
            'level_name' => 'required|unique:member_levels,level_name,' . $this->get('id') . '|max:255',
            'rate' => 'required|min:0|max:100',
        ];
    }
}
