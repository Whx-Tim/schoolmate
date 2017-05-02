<?php

namespace App\Http\Requests;

use App\Http\Requests\AuthCheckRequest as FormRequest;

class StoreMessageRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'required',
            'send_to' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'content.required' => '请不要发送空消息',
            'send_to.required' => '发送对象不可为空',
        ];
    }
}
