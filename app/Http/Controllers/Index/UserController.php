<?php

namespace App\Http\Controllers\Index;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * 获取用户信息
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserInfo(User $user)
    {
        $userInfo = $user->info;

        return $this->ajaxResponse(0, '操作成功', compact('userInfo'));
    }

    /**
     * 获取当前用户id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuthUserId()
    {
        return $this->ajaxResponse(0, '操作成功', ['id' => Auth::user()->id]);
    }


    /**
     * 获取当前登录用户信息
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuthUserInfo()
    {
        return $this->ajaxResponse(0, '操作成功', ['user' => Auth::user()->info]);
    }


    /**
     * 更新用户信息
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUserInfo(Request $request)
    {
        try {
            User::where('id',Auth::user()->id)->update($request->except(['_token','_method','_id']));
        } catch (\Exception $e) {
            Log::info('更新用户信息异常： '. $e);

            return $this->ajaxResponse(1, '更新异常');
        }

        return $this->ajaxResponse(0, '更新成功');
    }

    /**
     * 获取用户发布过的活动
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserActives()
    {
        $actives = Auth::user()->actives;

        return $this->ajaxResponse(0, '操作成功', compact('actives'));
    }

    /**
     * 获取用户创建过的课程
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserCourses()
    {
        $courses = Auth::user()->courses;

        return $this->ajaxResponse(0, '操作成功', compact('courses'));
    }

    /**
     * 获取用户参与的活动
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserApplyActives()
    {
        $actives = Auth::user()->applyActives;

        return $this->ajaxResponse(0, '操作成功', compact('actives'));
    }

    /**
     * 获取用户参与的课程
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserAppplyCourses()
    {
        $courses = Auth::user()->applyCourses;

        return $this->ajaxResponse(0, '操作成功', compact('courses'));
    }
}
