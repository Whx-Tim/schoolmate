<?php

namespace App\Http\Requests;

use App\Http\Requests\AuthCheckRequest as FormRequest;

class StoreLeagueRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'   => 'required',
            'amount' => 'required',
            'introduction' => 'required',
            'type'         => 'required',
            'poster'       => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '请输入社团名称',
            'amount.required' => '请输入社团限制人数',
            'introduction.required' => '请输入社团的介绍',
            'type.required'         => '请选择社团的类型',
            'poster.required'       => '请上传社团封面图片'
        ];
    }
}
