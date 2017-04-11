<?php

namespace App\Http\Requests;

use App\Http\Requests\AuthCheckRequest as FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreActiveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'    => 'required',
            'time'    => 'required',
            'address' => 'required',
            'lnt'     => 'required',
            'lat'     => 'required',
            'poster'  => 'required',
            'person'   => 'required',
            'phone'   => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => '请填写活动名称',
            'time.required'    => '请填写活动时间',
            'address.required' => '请填写活动地址',
            'lnt.required'     => '请在地图上标注活动举办位置',
            'lat.required'     => '请在地图上标注活动举办位置',
            'poster.required'  => '请上传活动海报图片',
            'person.required'  => '请填写活动的人数限制',
            'phone.required'   => '请输入联系人电话'
        ];
    }
}
