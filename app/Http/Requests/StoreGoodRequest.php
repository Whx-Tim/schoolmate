<?php

namespace App\Http\Requests;

use App\Http\Requests\AuthCheckRequest as FormRequest;

class StoreGoodRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'shopName'    => 'required',
            'shopPrice'   => 'required',
            'shopType'    => 'required',
            'shopNumber'  => 'required',
            'shopPicture' => 'required',
        ];
    }

    public function messages()
    {
        return  [
            'shopName.required' => '请输入商品名称',
            'shopPrice.required' => '请输入商品价格',
            'shopType.required' => '请选择商品类型',
            'shopNumber.required' => '请输入商品的数量',
            'shopPicture.required' => '请上传商品的图片'
        ];
    }
}
