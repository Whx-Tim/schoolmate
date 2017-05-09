<?php

namespace App\Http\Controllers\Admin;

use App\Model\View;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

    public function show()
    {
        $day_users = User::whereDay('created_at',Carbon::now()->day)->count();
        $month_users = User::whereMonth('created_at', Carbon::now()->month)->count();
        $users = User::count();
        for ($i=0; $i <= 7;$i++) {
            $prev_day[8-$i] = [
                'count' => User::whereDay('created_at',Carbon::now()->subDays($i)->day)->count(),
                'index' => Carbon::now()->subDays($i)->day
            ];
        }
        for ($i=11; $i >=0;$i--) {
            $prev_month[$i] = [
                'count' => User::whereMonth('created_at',Carbon::now()->subMonths($i)->month)->count(),
                'index' => Carbon::now()->subMonths($i)->month
            ];
        }
        $view_active = View::where('view_type','App\Model\Active')->sum('count');
        $view_course = View::where('view_type','App\Model\Course')->sum('count');
        $view_league = View::where('view_type','App\Model\League')->sum('count');
        $view_announcement = View::where('view_type','App\Model\Announcement')->sum('count');
        $view_info = View::where('view_type','App\Model\Partime')->sum('count');
        $views = View::sum('count');
        return view('admin.index', compact('day_users', 'month_users', 'users' ,'prev_day','prev_month','view_active','view_course','view_league','view_announcement','view_info','views'));
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'image'
        ], [
            'file.image' => '请上传图片类型的文件'
        ]);

        $file = $request->file('file');
        $name = time().'_'.str_random(5).'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads/images/'), $name);
        $path = '/uploads/images/'.$name;

        return $this->ajaxResponse(0, '上传成功', compact('path'));
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => '用户名不可为空',
            'password.required' => '密码不可为空',
        ]);

        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')]) || Auth::attempt(['email' => $request->input('username'), 'password' => $request->input('password')])) {
            if (Auth::user()->info->adminset == 5) {
                return $this->ajaxResponse(0, '登录成功');
            } else {
                return $this->ajaxResponse(1, '你没有权限登录后台系统');
            }
        } else {
            return $this->ajaxResponse(2, '用户名密码错误');
        }
    }

    public function showLogin()
    {
        return view('admin.login');
    }

    public function setting()
    {
        return view('admin.setting.index');
    }
}
