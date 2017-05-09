<?php

namespace App\Http\Requests;

use App\Http\Requests\AuthCheckRequest as FormRequest;

class UserRegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:users',
            'password' => 'required|confirmed',
            'email'    => 'required|email|unique:users',
            'realname' => 'required',
            'student_id' => 'required'

        ];
    }

    public function messages()
    {
        return [
            'username.required' => '请输入用户名',
            'username.unique'   => '用户名已存在',
            'password.required' => '请输入密码',
            'password.confirmed'=> '两次输入的密码不一致',
            'email.required'    => '请输入邮箱',
            'email.email'       => '请输入正确的邮箱格式',
            'email.unique'      => '该邮箱已被注册',
            'realname.required' => '请输入真实姓名',
            'student_id.required' => '请输入学号'
        ];
    }
}
