<?php

namespace App\Http\Controllers\Index;

use App\Http\Requests\StoreActiveRequest;
use App\Model\Active;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class ActiveController extends Controller
{

    /**
     * 获取活动列表
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getActiveList(Request $request)
    {
        $actives = $this->getListOrderByDesc(new Active(), $request);

        return $this->ajaxResponse(0, '初始化数据成功!', compact('actives'));
    }

    /**
     * 获取活动详情
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getActive($id, Request $request)
    {
        if (empty($id)) {
            $active_id = $request->get('id');
        } else {
            $active_id = $id;
        }

        $active = Active::where('id', $active_id)->first()->toArray();

        return $this->ajaxResponse(0, '操作成功', compact('active'));
    }

    /**
     * 获取参与活动的用户
     *
     * @param Active $active
     * @return \Illuminate\Http\JsonResponse
     */
    public function getApplyUsers(Active $active)
    {
        $users = $active->users;

        return $this->ajaxResponse(0, '操作成功', compact('users'));
    }

    /**
     * 发布活动
     *
     * @param StoreActiveRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeActive(StoreActiveRequest $request)
    {
        try {
            $active = Active::create($request->except(['_method','_token']));
        } catch (\Exception $exception) {
            Log::info('活动保存失败:'.$exception);
            return $this->ajaxResponse(1, '保存失败', compact('exception'));
        }

        return $this->ajaxResponse(0, '保存成功', compact('active'));
    }

    /**
     * 更新活动
     *
     * @param Active $active
     * @param StoreActiveRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateActive(Active $active, StoreActiveRequest $request)
    {
        try {
            $active->update($request->except(['_method', '_token']));
        } catch (\Exception $exception) {
            Log::info('活动更新失败:'.$exception);
            return $this->ajaxResponse(1, '保存失败，请联系管理员', compact('exception'));
        }

        return $this->ajaxResponse(0, '更新成功');
    }
}
