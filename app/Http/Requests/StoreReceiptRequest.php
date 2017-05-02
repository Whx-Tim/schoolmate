<?php

namespace App\Http\Requests;

use App\Http\Requests\AuthCheckRequest as FormRequest;

class StoreReceiptRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'consignee' => 'required',
            'address'   => 'required',
            'phone'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'consignee.required' => '请输入收货人',
            'address.required'   => '请输入收货地址',
            'phone.required'     => '请输入联系电话'
        ];
    }
}
