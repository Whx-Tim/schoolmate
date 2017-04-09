<?php

namespace App\Http\Controllers\Index;

use App\Http\Requests\StoreLeagueRequest;
use App\Model\League;
use App\Model\LeagueGroup;
use Auth;
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

    /**
     * @api {get} league/detail/{league_id} 获取社团详情
     * @apiName getLeagueDetail
     * @apiGroup League
     *
     * @apiSuccess {String} name 社团名称
     * @apiSuccess {Number} amount 限制人数
     * @apiSuccess {String} introduction 社团介绍
     * @apiSuccess {Number} type 社团类型，1:摄影,2:技术,3:社交,4:管理,5:艺术,6:其他
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
    public function getLeague(League $league)
    {
        return $this->ajaxResponse(0, '操作成功', compact('league'));
    }

    /**
     * @api {post} league/store 创建社团
     * @apiName StoreLeague
     * @apiGroup League
     *
     * @apiParam {String} name 社团名称
     * @apiParam {Number} amount 限制人数
     * @apiParam {String} introduction 社团介绍
     * @apiParam {Number=1,2,3,4,5,6} type 社团类型，1:摄影,2:技术,3:社交,4:管理,5:艺术,6:其他
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
    public function storeLeague(StoreLeagueRequest $request)
    {
        try {
            $league = League::create($request->except('_token','_method','id'));
        } catch (\Exception $exception) {
            Log::info('社团创建异常:'. $exception);

            return $this->ajaxResponse(1, '创建失败');
        }

        return $this->ajaxResponse(0, '创建成功', compact('league'));
    }

    /**
     * @api {post} league/update/{league_id} 创建社团
     * @apiName updateLeague
     * @apiGroup League
     *
     * @apiParam {String} name 社团名称
     * @apiParam {Number} amount 限制人数
     * @apiParam {String} introduction 社团介绍
     * @apiParam {Number=1,2,3,4,5,6} type 社团类型，1:摄影,2:技术,3:社交,4:管理,5:艺术,6:其他
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
    public function updateLeague(StoreLeagueRequest $request, League $league)
    {
        try {
            $league->update($request->except('_token','_method','id'));
        } catch (\Exception $exception) {
            Log::info('社团更新异常：'. $exception);

            return $this->ajaxResponse(1, '更新失败');
        }

        return $this->ajaxResponse(0, '更新成功');
    }

    /**
     * @api {get} league/apply/{league_id} 参与社团
     * @apiName applyLeague
     * @apiGroup League
     *
     * @apiSuccessExample Success-Response:
     *      Http/1.1 200 OK
     *      {
     *          "errcode": 0,
     *          "errmsg": "操作成功",
     *          "data": {
     *          }
     *      }
     */
    public function applyLeague($league)
    {
        try {
            LeagueGroup::create([
                'user_id' => Auth::id(),
                'league_id' => $league
            ]);
        } catch (\Exception $exception) {
            Log::info('参与社团异常:'. $exception);

            return $this->ajaxResponse(1, '参与社团失败');
        }

        return $this->ajaxResponse(0, '参与成功');
    }
}
