<?php

namespace App\Http\Controllers\Index;

use App\Events\Created;
use App\Http\Requests\StorePartimeRequest;
use App\Model\Announcement;
use App\Model\Partime;
use App\Model\UserInfo;
use App\User;
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
//        $user = UserInfo::where('adminset', 5)->first();

        $announcements = Announcement::with('view')->where('announcement_type','App\User')->paginate($request->get('per_page'));
        $announcements_json = $announcements->toArray();
        $announcements_json['data'] = $announcements->each(function ($announcement) {
            $announcement->comment_count = $announcement->comments()->count();
        });
        $announcements = $announcements_json;

//        foreach ($announcements->data as $announcement) {
//            $announcement->comments()->count();
//        }
//        $announcement = $this->getListOrderByDesc(new Announcement(), $request);

        return $this->ajaxResponse(0, '操作成功', compact('announcements'));
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
//        $partime->view()->increment('count');

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
     * @apiSuccess {Number} view 访问量
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
//        $announcement->view()->increment('count');
//        $view = $announcement->view;
        return $this->ajaxResponse(0, '操作成功', compact('announcement'));
    }

    /**
     * @api {get} info/list/active 获取参与的活动的公告
     * @apiName getUserActiveAnnouncement
     * @apiGroup Info
     *
     * @apiSuccess {Number} id 公告id
     * @apiSuccess {String} title 标题
     * @apiSuccess {String} content 内容
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
    public function getUserActiveAnnouncements(Request $request)
    {
        $actives = Auth::user()->applyActives()->paginate($request->get('per_page'));
        $announcements = $actives->toArray();
        $announcements['data'] = $actives->map(function ($active) {
            return $active->announcements;
        })->flatten();
//        $announcements_array = [];
//        foreach($actives as $active) {
//            $announcements = $active->announcements;
//            foreach ($announcements as $announcement) {
//                array_push($announcements_array, $announcement);
//            }
//        }
//        $announcements = Auth::user()->activeAnnouncements;

        return $this->ajaxResponse(0, '操作成功', compact('announcements'));
    }

    /**
     * @api {get} info/list/course 获取参与的课程的公告
     * @apiName getUserCourseAnnouncement
     * @apiGroup Info
     *
     * @apiSuccess {Number} id 公告id
     * @apiSuccess {String} title 标题
     * @apiSuccess {String} content 内容
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
    public function getUserCourseAnnouncements(Request $request)
    {
        $courses = Auth::user()->applyCourses()->paginate($request->get('per_page'));
        $announcements = $courses->toArray();
        $announcements['data'] = $courses->map(function ($course) {
            return $course->announcements;
        })->flatten();
//        dd($courses);
//        $announcements_array = [];
//        foreach ($courses as $course) {
//            $announcements = $course->announcements;
////            dd($announcements);
//            foreach ($announcements as $announcement) {
//                array_push($announcements_array, $announcement);
//            }
//        }
//        $announcements = Auth::user()->applyCourses()->announcements()->get();
//        $announcements = Auth::user()->courseAnnouncements()->get();

        return $this->ajaxResponse(0, '操作成功', compact('announcements'));
    }

    /**
     * @api {get} info/list/league 获取参与的社团的公告
     * @apiName getUserLeagueAnnouncement
     * @apiGroup Info
     *
     * @apiSuccess {Number} id 公告id
     * @apiSuccess {String} title 标题
     * @apiSuccess {String} content 内容
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
    public function getUserLeagueAnnouncements()
    {
        $leagues = Auth::user()->applyLeagues;
        $announcements = $leagues->toArray();
        $announcements['data'] = $leagues->map(function ($league) {
            return $league->announcements;
        })->flatten();
//        $announcements_array = [];
//        foreach ($leagues as $league) {
//            $announcements = $league->announcements;
//            foreach ($announcements as $announcement) {
//                array_push($announcements_array, $announcement);
//            }
//        }
//        $announcements = Auth::user()->leagueAnnouncements;

        return $this->ajaxResponse(0, '操作成功', compact('announcements'));
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
            $partime = Partime::create($data);
            $partime->check()->create([]);
            event(new Created(Auth::user()->username.'发布了兼职信息'));
        } catch (\Exception $exception) {
            Log::info('发布兼职信息异常：'. $exception);

            return $this->ajaxResponse(1, '发布失败');
        }

        return $this->ajaxResponse(0, '发布成功');
    }

    /**
     * @api {get} info/comment/list/{announcement_id} 获取评论列表
     * @apiName getInfoCommentList
     * @apiGroup Info
     *
     * @apiSuccess {Number} id 评论id
     * @apiSuccess {String} content 评论内容
     * @apiSuccess {Number} user_id 发布评论的用户id
     * @apiSuccess {Date}   created_at 创建时间
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
    public function getCommentList(Announcement $announcement,Request $request)
    {
        $comments = $announcement->comments()->orderBy('created_at', 'desc')->paginate($request->get('per_page'));
        $data = $comments->toArray();
        $data['data'] = $comments->each(function ($comment) {
            $comment->username = $comment->user->username;
            $comment->head_img = $comment->user->info->wx_head_img;
        });
        $comments = $data;

        return $this->ajaxResponse(0, '操作成功', compact('comments'));
    }

    public function storeComment(Request $request, Announcement $announcement)
    {
        $this->validate($request, [
            'content' => 'required'
        ], [
            'content.required' => '请不要发送空消息'
        ]);
        $data = $request->only('content');
        $data['user_id'] = $request->user()->id;
        $comment = $announcement->comments()->create($data);

        return $this->ajaxResponse(0, '发布成功', compact('comment'));
    }

}
