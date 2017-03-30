<?php

namespace App\Http\Requests;

use App\Http\Requests\AuthCheckRequest as FormRequest;

class StoreCourseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'number'  => 'required',
            'name'    => 'required',
            'teacher' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'number.required'  => '请输入课程号',
            'name.required'    => '请输入课程名称',
            'teacher.required' => '请输入任课老师'
        ];
    }
}
