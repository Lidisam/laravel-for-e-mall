<?php

namespace App\Http\Requests;


class AdUpdateRequest extends Request
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
            'ad_name.required' => '广告名不能为空',
            'ad_name.unique' => '该广告名已存在',
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
            'ad_name' => 'required|unique:ads,ad_name,' . $this->get('id') . '|max:255',
        ];
    }
}
