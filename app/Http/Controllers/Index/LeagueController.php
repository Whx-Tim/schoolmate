<?php

namespace App\Http\Controllers\Index;

use App\Http\Requests\StoreLeagueRequest;
use App\Model\League;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class LeagueController extends Controller
{
    /**
     * @api {Get} /league/list 获取社团列表
     * @apiName LeagueGetList
     * @apiGroup League
     *
     * @apiParam {Number} [page=0] 当前页码
     * @apiParam {String="amount","created_at"} [condition=created_at] 筛选条件排序
     *
     * @apiSuccess {Number} id 社团id
     * @apiSuccess {String} name 社团名称
     * @apiSuccess {Number} amount 限制人数
     * @apiSuccess {Text}   introduction 社团介绍
     * @apiSuccess {Number} type 社团类型,1:摄影,2:技术,3:社交,4:管理,5:艺术,6:其他
     * @apiSuccess {Number} user_id 用户id，外键
     * @apiSuccess {Date} created_at 创建时间
     *
     * @apiSuccessExample Success-Response:
     *      Http/1.1 200 OK
     *      {
     *          "errcode": 0,
     *          "errmsg": "操作成功",
     *          "data": {
     *          }
     *      }
     *
     */
    public function getList(Request $request)
    {
        $leagues = $this->getListOrderByDesc(new League(), $request);

        return $this->ajaxResponse(0, '操作成功', compact('leagues'));
    }

    public function getLeague(League $league)
    {
        return $this->ajaxResponse(0, '操作成功', compact('league'));
    }

    public function storeLeague(StoreLeagueRequest $request)
    {
        try {
            $league = League::create($request->except('_token','_method','_id'));
        } catch (\Exception $exception) {
            Log::info('社团创建异常:'. $exception);

            return $this->ajaxResponse(1, '创建失败');
        }

        return $this->ajaxResponse(0, '创建成功', compact('league'));
    }
}
