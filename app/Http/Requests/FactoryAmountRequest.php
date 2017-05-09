<?php

namespace App\Http\Requests;

use App\Http\Requests\AuthCheckRequest as FormRequest;

class FactoryAmountRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => '请输入数量来生成数据'
        ];
    }
}
