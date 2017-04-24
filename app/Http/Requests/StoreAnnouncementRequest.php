<?php

namespace App\Http\Requests;

use App\Http\Requests\AuthCheckRequest as FormRequest;

class StoreAnnouncementRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return  [
            'title.required' => '请输入标题',
            'content.required' => '请输入公告内容'
        ];
    }
}
