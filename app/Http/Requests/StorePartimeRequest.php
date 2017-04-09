<?php

namespace App\Http\Requests;

use App\Http\Requests\AuthCheckRequest as FormRequest;

class StorePartimeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name' => 'required',
            'address'      => 'required',
            'position'     => 'required',
            'phone'        => 'required',
            'email'        => 'required',
            'salary'       => 'required',
            'job_time'     => 'required|in:1,2,3,4,5,6,7|integer',
            'company_type' => 'required',
            'duration'     => 'required',
            'education'    => 'required',
            'amount'       => 'required|integer',
            'end_time'     => 'required'
        ];
    }

    public function messages()
    {
        return [
            'company_name.required' => '请输入公司名称',
            'address.required'      => '请输入办公地点',
            'position.required'     => '请输入招聘的岗位',
            'phone.required'        => '请输入公司电话',
            'email.required'        => '请输入公司邮箱',
            'salary.required'       => '请输入招聘薪资',
            'job_time.required'     => '请输入一周工作时间',
            'job_time.in'           => '请按要求选择工作时长',
            'job_time.integer'      => '请按要求选择工作时长',
            'company_type.required' => '请输入公司类型',
            'duration.required'     => '请输入就职至少时长',
            'education.required'    => '请输入职位学历要求',
            'amount.required'       => '请输入招聘人数',
            'end_time.required'     => '请输入截止时间'
        ];
    }
}
