<?php

namespace App\Http\Controllers\Index;

use App\Http\Requests\StorePartimeRequest;
use App\Model\Announcement;
use App\Model\Partime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class InfoController extends Controller
{
//    public function getAllList(Request $request)
//    {
//        $partime = $this->getListOrderByDesc(new Partime(), $request);
//        $announcement = $this->getListOrderByDesc(new Announcement(), $request);
//
//        $data = collect($partime)->merge($announcement);
//        dd($data);
//
//
//    }

    /**
     * @api {get} info/partimeList 获取兼职列表信息
     * @apiName getPartimeList
     * @apiGroup Info
     *
     * @apiParam {Number=0} page 当前页码
     * @apiParam {Number=10} per_page 当前页显示数量
     * @apiParam {String="created_at","updated_at"} condition 排序条件
     *
     * @apiSuccess {Number} id 兼职信息id
     * @apiSuccess {String} company_name 公司名称
     * @apiSuccess {String} address 办公地点
     * @apiSuccess {String} phone 公司联系电话
     * @apiSuccess {String} email 公司联系邮箱
     * @apiSuccess {String} salary 岗位薪资
     * @apiSuccess {Number} job_time 一周至少工作天数
     * @apiSuccess {String} company_type 公司类型
     * @apiSuccess {Text} description 兼职招聘描述
     * @apiSuccess {String} duration 本次工作至少时长
     * @apiSuccess {String} education 学历要求
     * @apiSuccess {Number} amount 招聘人数
     * @apiSuccess {Date} end_time 截止时间
     * @apiSuccess {Date} created_at 创建时间
     * @apiSuccess {Date} updated_at 更新时间
     * @apiSuccess {Date} deleted_at 删除时间
     * @apiSuccess {Number} user_id 发布用户id
     * @apiSuccess {String} position 招聘岗位
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "操作成功",
     *         "data": {
     *         }
     *     }
     */
    public function getPartimeList(Request $request)
    {
        $partime = $this->getListOrderByDesc(new Partime(), $request);

        return $this->ajaxResponse(0, '操作成功', compact('partime'));
    }

    /**
     * @api {get} info/announcementList 获取公告信息
     * @apiName getAnnouncementList
     * @apiGroup Info
     *
     * @apiParam {Number=0} page 当前页码
     * @apiParam {Number=10} per_page 当前页显示数量
     * @apiParam {String="created_at","updated_at"} condition 排序条件
     *
     * @apiSuccess {Number} id 信息id
     * @apiSuccess {String} title 信息标题
     * @apiSuccess {String} description 信息描述
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "操作成功",
     *         "data": {
     *         }
     *     }
     */
    public function getAnnouncementList(Request $request)
    {
        $announcement = $this->getListOrderByDesc(new Announcement(), $request);

        return $this->ajaxResponse(0, '操作成功', compact('announcement'));
    }

    /**
     * @api {get} info/partime/detail/{partime_id} 获取招聘信息详情
     * @apiName getPartimeDetail
     * @apiGroup Info
     *
     * @apiSuccess {Number} id 兼职信息id
     * @apiSuccess {String} company_name 公司名称
     * @apiSuccess {String} address 办公地点
     * @apiSuccess {String} phone 公司联系电话
     * @apiSuccess {String} email 公司联系邮箱
     * @apiSuccess {String} salary 岗位薪资
     * @apiSuccess {Number} job_time 一周至少工作天数
     * @apiSuccess {String} company_type 公司类型
     * @apiSuccess {Text} description 兼职招聘描述
     * @apiSuccess {String} duration 本次工作至少时长
     * @apiSuccess {String} education 学历要求
     * @apiSuccess {Number} amount 招聘人数
     * @apiSuccess {Date} end_time 截止时间
     * @apiSuccess {Date} created_at 创建时间
     * @apiSuccess {Date} updated_at 更新时间
     * @apiSuccess {Date} deleted_at 删除时间
     * @apiSuccess {Number} user_id 发布用户id
     * @apiSuccess {String} position 招聘岗位
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "操作成功",
     *         "data": {
     *         }
     *     }
     *
     */
    public function getPartimeDetail(Partime $partime)
    {
        return $this->ajaxResponse(0, '操作成功', compact('partime'));
    }

    /**
     * @api {get} info/announcement/detail/{announcement_id} 获取公告详情
     * @apiName getAnnouncementDetail
     * @apiGroup Info
     *
     * @apiSuccess {Number} id 信息id
     * @apiSuccess {String} title 信息标题
     * @apiSuccess {String} description 信息描述
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "操作成功",
     *         "data": {
     *         }
     *     }
     */
    public function getAnnouncement(Announcement $announcement)
    {
        return $this->ajaxResponse(0, '操作成功', compact('announcement'));
    }

    public function getUserActiveAnnouncements()
    {
        $actives = Auth::user()->applyActives;
        dd($actives);
        $announcements = array();
        foreach ($actives as $active) {
            $announcements[] = $active->announcements;
        }
    }


    /**
     * @api {post} info/partime/store 发布兼职信息
     * @apiName storePartime
     * @apiGroup Info
     *
     * @apiParam {String} company_name 公司名称
     * @apiParam {String} address 办公地点
     * @apiParam {String} phone 公司联系电话
     * @apiParam {String} email 公司联系邮箱
     * @apiParam {String} salary 岗位薪资
     * @apiParam {Number} job_time 一周至少工作天数
     * @apiParam {String} company_type 公司类型
     * @apiParam {Text} [description] 兼职招聘描述
     * @apiParam {String} duration 本次工作至少时长
     * @apiParam {String} education 学历要求
     * @apiParam {Number} amount 招聘人数
     * @apiParam {Date} end_time 截止时间
     * @apiParam {String} position 招聘岗位
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "发布成功",
     *         "data": {
     *         }
     *     }
     */
    public function storePartime(StorePartimeRequest $request)
    {
        try {
            $data = $request->except(['_token','_method']);
            $data['user_id'] = Auth::id();
            Partime::create($data);
        } catch (\Exception $exception) {
            Log::info('发布兼职信息异常：'. $exception);

            return $this->ajaxResponse(1, '发布失败');
        }

        return $this->ajaxResponse(0, '发布成功');
    }
}
