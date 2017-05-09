<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    //

    public function index()
    {
        return view('admin.setting.index');
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'password'     => 'required|confirmed'
        ], [
            'password.required'     => '请输入新的密码',
            'password.confirmed'    => '两次密码不一致'
        ]);
        Auth::user()->update(['password' => bcrypt($request->input('password'))]);

        return $this->ajaxResponse(0, '更新成功');
    }

    public function logout()
    {
        Auth::logout();

        return view('admin.login');
    }
}
