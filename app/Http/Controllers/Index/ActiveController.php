<?php

namespace App\Http\Controllers\Index;

use App\Http\Requests\StoreActiveRequest;
use App\Http\Requests\StoreAnnouncementRequest;
use App\Model\Active;
use App\Model\ActiveApply;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class ActiveController extends Controller
{

    /**
     * @api {get} active/list 获取活动列表
     * @apiName getActiveList
     * @apiGroup Active
     *
     * @apiParam {Number} [page=0] 当前页码
     * @apiParam {String="created_at","updated_at"} [condition=created_at] 筛选条件
     *
     * @apiSuccess {Number} id 活动id
     * @apiSuccess {String} name 活动名称
     * @apiSuccess {String} time 活动时间
     * @apiSuccess {String} address 活动地址
     * @apiSuccess {String} lnt 经度
     * @apiSuccess {String} lat 纬度
     * @apiSuccess {String} poster 活动海报图片url
     * @apiSuccess {String} images 活动图片Url
     * @apiSuccess {Number} count 参与人数
     * @apiSuccess {String} phone 联系电话
     * @apiSuccess {Text}   description 活动描述
     * @apiSuccess {Number} status 活动状态
     * @apiSuccess {Number} person 人数限制
     * @apiSuccess {Float}  money 报名金额
     * @apiSuccess {Number} user_id 创建活动的用户id，外键
     * @apiSuccess {Date}   created_at 创建时间
     * @apiSuccess {Date}   updated_at 更新时间
     * @apiSuccess {Date}   deleted_at 删除时间
     * @apiSuccess {String} condition 选择条件
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
    public function getActiveList(Request $request)
    {
        $actives = $this->getListOrderByDesc(new Active(), $request);

        return $this->ajaxResponse(0, '初始化数据成功!', compact('actives'));
    }

    /**
     * @api {get} active/detail/{active_id} 获取活动详情
     * @apiName getActiveDetail
     * @apiGroup Active
     *
     * @apiSuccess {Number} id 活动id
     * @apiSuccess {String} name 活动名称
     * @apiSuccess {String} time 活动时间
     * @apiSuccess {String} address 活动地址
     * @apiSuccess {String} lnt 经度
     * @apiSuccess {String} lat 纬度
     * @apiSuccess {String} poster 活动海报图片url
     * @apiSuccess {String} images 活动图片Url
     * @apiSuccess {Number} count 参与人数
     * @apiSuccess {String} phone 联系电话
     * @apiSuccess {Text}   description 活动描述
     * @apiSuccess {Number} status 活动状态
     * @apiSuccess {Number} person 人数限制
     * @apiSuccess {Float}  money 报名金额
     * @apiSuccess {Number} user_id 创建活动的用户id，外键
     * @apiSuccess {Date}   created_at 创建时间
     * @apiSuccess {Date}   updated_at 更新时间
     * @apiSuccess {Date}   deleted_at 删除时间
     * @apiSuccess {String} condition 选择条件
     * @apiSuccess {Number=0,1} can_publish 是否可以发布该活动公告，0：否，1：是
     * @apiSuccess {Boole}  applied 是否已参与
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
    public function getActive(Active $active)
    {
        $active->view()->increment('count');
        $can_publish = $this->canPublish($active);
        $applied = ActiveApply::where([
            'active_id' => $active->id,
            'user_id'   => Auth::id()
        ])->first() ? true : false;
        return $this->ajaxResponse(0, '操作成功', compact('active', 'can_publish','applied'));
    }

    /**
     * @api {get} active/getApplyActiveUsers/{active_id} 获取参与active_id活动的用户信息
     * @apiName getApplyActiveUsers
     * @apiGroup Active
     *
     * @apiSuccess {Number} id 用户id
     * @apiSuccess {String} name 昵称
     * @apiSuccess {String} realname 真实姓名
     * @apiSuccess {Number} student_id 学号
     * @apiSuccess {String} college 学院
     * @apiSuccess {String} grade 年级
     * @apiSuccess {Number=1,2} gender 性别，1：男，2：女
     * @apiSuccess {String} phone 手机
     * @apiSuccess {String} wx_openid 微信openid
     * @apiSuccess {String} wx_head_img 微信头像Url
     * @apiSuccess {String} wx_nickname 微信昵称
     * @apiSuccess {String} birthday 生日
     * @apiSuccess {Number} user_id 用户id
     * @apiSuccess {Number} is_certified 是否认证，默认0，1：已认证
     * @apiSuccess {Number} adminset 管理员权限
     * @apiSuccess {Date}   created_at 创建时间
     * @apiSuccess {Date}   updated_at 更新时间
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
    public function getApplyUsers(Active $active)
    {
        $users = $active->users;
        $users = $users->map(function ($item, $key) {
            return $item->info;
        });

        return $this->ajaxResponse(0, '操作成功', compact('users'));
    }

    /**
     * @api {post} active/storeActive 创建活动
     * @apiName storeActive
     * @apiGroup Active
     *
     * @apiParam {String} name 活动名称
     * @apiParam {String} time 活动时间
     * @apiParam {String} address 活动地址
     * @apiParam {String} lng 经度
     * @apiParam {String} lat 纬度
     * @apiParam {String} poster 活动海报url
     * @apiParam {String} [images] 活动图片url
     * @apiParam {String} phone 联系电话
     * @apiParam {String} [description] 活动描述
     * @apiParam {Number} [person] 限制人数
     * @apiParam {Float}  [money] 报名金额
     * @apiParam {String} [condition] 邀请条件
     *
     * @apiSuccess {Number} id 活动id
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "保存成功",
     *         "data": {
     *         }
     *     }
     *
     */
    public function storeActive(StoreActiveRequest $request)
    {
        try {
            $data = $request->except(['_token', '_method']);
            $data['user_id'] = Auth::id();
            $active = Active::create($data);
            $this->applyActive($active->id);
        } catch (\Exception $exception) {
            Log::info('活动保存失败:'.$exception);
            return $this->ajaxResponse(1, '保存失败', compact('exception'));
        }

        return $this->ajaxResponse(0, '保存成功', compact('active'));
    }

    /**
     * @api {post} active/updateActive 更新活动
     * @apiName updateActive
     * @apiGroup Active
     *
     * @apiParam {String} name 活动名称
     * @apiParam {String} time 活动时间
     * @apiParam {String} address 活动地址
     * @apiParam {String} lng 经度
     * @apiParam {String} lat 纬度
     * @apiParam {String} poster 活动海报url
     * @apiParam {String} [images] 活动图片url
     * @apiParam {String} phone 联系电话
     * @apiParam {String} [description] 活动描述
     * @apiParam {Number} [person] 限制人数
     * @apiParam {Float}  [money] 报名金额
     * @apiParam {String} [condition] 邀请条件
     *
     * @apiSuccess {Number} id 活动id
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "更新成功",
     *         "data": {
     *         }
     *     }
     *
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

    /**
     * @api {get} active/apply/{active_id} 参与活动
     * @apiName applyActive
     * @apiGroup Active
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "更新成功",
     *         "data": {
     *         }
     *     }
     */
    public function applyActive($active)
    {
        try {
            ActiveApply::create([
                'user_id' => Auth::id(),
                'active_id' => $active
            ]);
        } catch (\Exception $exception) {
            Log::info('参与活动异常：'.$exception);

            return $this->ajaxResponse(1, '参与活动失败');
        }

        return $this->ajaxResponse(0, '参与成功');
    }

    /**
     * @api {post} active/upload/poster 活动上传图片
     * @apiName activeUploadPoster
     * @apiGroup Active
     *
     * @apiParam {File} image 上传的活动图片
     *
     * @apiSuccess {String} image 活动图片路径
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "更新成功",
     *         "data": {
     *         }
     *     }
     *
     */
    public function uploadPoster(Request $request)
    {
        $this->validate($request, [
            'image' => 'image'
        ], [
            'image.image'    => '接受的文件不是图片'
        ]);

//        $image = $request->file('image')->store('uploads/images/');

        $file = $request->file('image');
        $name = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads/images/'), $name);
        $image = '/uploads/images/'.$name;
//        try {
//
////            $active->update(['poster' => $image]);
//        } catch (\Exception $exception) {
//            Log::info('活动图片上传异常：'. $exception);
//
//            return $this->ajaxResponse(1, '上传失败');
//        }

        return $this->ajaxResponse(0, '上传成功', compact('image'));
    }

    /**
     * @api {post} active/info/publish/{active_id} 活动创建者发布活动公告
     * @apiName UserPublishInfo
     * @apiGroup Active
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
     *         "errmsg": "你没有权限发布该课程公告",
     *         "data": {
     *         }
     *     }
     */
    public function publishAnnouncement(Active $active, StoreAnnouncementRequest $request)
    {
        if ($this->canPublish($active)) {
            $announcement = $active->announcements()->create($request->only(['title','content']));
            $announcement->check()->create([]);
        } else {
            return $this->ajaxResponse(2, '您没有权限发布该活动公告');
        }

        return $this->ajaxResponse(0, '发布成功', compact('announcement'));
    }

    public function callbackTest(Request $request)
    {
        $code = $request->input('code');

        $data = $this->send_post('http://wx.lewitech.cn/wechat/oauth/userinfo', compact('code'));
        dd($data);
    }

    public function send_post($url, $data)
    {
        $postData = http_build_query($data);
        $options  = [
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-type:application/x-www-form-urlencoded',
                'content' => $postData,
                'timeout' => 15*60
            ]
        ];
        $context = stream_context_create($options);
        return file_get_contents($url, false, $context);
    }
}
