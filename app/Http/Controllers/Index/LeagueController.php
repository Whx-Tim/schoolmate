<?php

namespace App\Http\Controllers\Index;

use App\Http\Requests\StoreAnnouncementRequest;
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
     * @api {Get} league/list 获取社团列表
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
     * @apiSuccess {Number=0,1} can_publish 是否有发布的权限0：否，1：可
     * @apiSuccess {Bool}   applied 是否参与社团
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
        $league->view()->increment('count');
        $can_publish = $this->canPublish($league);
        $applied = LeagueGroup::where([
            'league_id' => $league->id,
            'user_id'   => Auth::id()
        ])->first() ? true : false;
        return $this->ajaxResponse(0, '操作成功', compact('league', 'can_publish', 'applied'));
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
            $data = $request->except('_token','_method','id');
            $data['user_id'] = Auth::id();
            $league = League::create($data);
            $this->applyLeague($league->id);
        } catch (\Exception $exception) {
            Log::info('社团创建异常:'. $exception);

            return $this->ajaxResponse(1, '创建失败');
        }

        return $this->ajaxResponse(0, '创建成功', compact('league'));
    }

    /**
     * @api {post} league/update/{league_id} 更新社团
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

    /**
     * @api {post} league/info/publish/{league_id} 发布社团公告
     * @apiName publishLeagueAnnouncement
     * @apiGroup League
     *
     * @apiParam {String} title 公告标题
     * @apiParam {String} content 公告内容
     *
     * @apiSuccess {Number} id 公告id
     * @apiSuccess {String} title 公告标题
     * @apiSuccess {String} content 公告内容
     * @apiSuccess {Number} announcement_id 课程外键id
     * @apiSuccess {String} announcement_type 公告类型
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "发布成功",
     *         "data": {
     *         }
     *     }
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 2,
     *         "errmsg": "你没有权限发布该社团公告",
     *         "data": {
     *         }
     *     }
     */
    public function publishAnnouncement(League $league, StoreAnnouncementRequest $request)
    {
        if ($league->user->id == Auth::id()) {
            $announcement = $league->announcements()->create($request->except(['_token','_method']));
        } else {
            return $this->ajaxResponse(1,'您没有权限发布社团公告');
        }

        return $this->ajaxResponse(0, '发布成功', compact('announcement'));
    }

    /**
     * @api {post} league/upload 社团上传照片
     * @apiName uploadLeaguePoster
     * @apiGroup League
     *
     * @apiParam {File} image 图片文件
     *
     * @apiSuccess {String} path 图片路径
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "上传成功",
     *         "data": {
     *         }
     *     }
     */
    public function uploadPoster(Request $request)
    {
        $this->validate($request, [
            'image' => 'images'
        ], [
            'image.images' => '上传的不是图片'
        ]);

        $file = $request->file('image');
        $name = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads/images/'), $name);
        $path = '/uploads/images/'.$name;

        return $this->ajaxResponse(0, '上传成功', compact('path'));
    }
}
