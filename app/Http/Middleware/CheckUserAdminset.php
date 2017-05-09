<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserAdminset
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if ($request->user()->info->adminset == 5) {
                return $next($request);
            } else {
                return view('admin.login', ['message' => '你没有权限登录后台管理系统']);
            }
        } else {
            return view('admin.login', ['message' => '账号密码错误']);
        }

    }
}
