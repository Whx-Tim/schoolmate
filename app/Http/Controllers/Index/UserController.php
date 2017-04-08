<?php

namespace App\Http\Controllers\Index;

use App\Model\Active;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * @api {get} user/info/{user_id} 获取用户详细信息
     * @apiName getUserInfo
     * @apiGroup User
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
    public function getUserInfo(User $user)
    {
        $userInfo = $user->info;

        return $this->ajaxResponse(0, '操作成功', compact('userInfo'));
    }

    /**
     * @api {get} user/auth/id 获取当前用户id
     * @apiName getAuthUserId
     * @apiGroup User
     *
     * @apiSuccess {Number} id 当前用户id
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
    public function getAuthUserId()
    {
        return $this->ajaxResponse(0, '操作成功', ['id' => Auth::user()->id]);
    }


    /**
     * @api {get} user/auth/info 获取当前登录用户信息
     * @apiName getAuthUserInfo
     * @apiGroup User
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
    public function getAuthUserInfo()
    {
        return $this->ajaxResponse(0, '操作成功', ['user' => Auth::user()->info]);
    }


    /**
     * @api {post} user/update 更新当前用户信息
     * @apiName updateAuthUserInfo
     * @apiGroup User
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
     * @api {get} user/actives 获取用户发布的活动
     * @apiName getUserActives
     * @apiGroup User
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
     */
    public function getUserActives()
    {
        $actives = Auth::user()->actives;

        return $this->ajaxResponse(0, '操作成功', compact('actives'));
    }

    /**
     * @api {get} user/courses 获取用户创建过的课程
     * @apiName getUserCourses
     * @apiGroup User
     *
     * @apiSuccess {Number} id 课程id
     * @apiSuccess {Number} number 课程号
     * @apiSuccess {String} name 课程名称
     * @apiSuccess {String} teacher 主讲教师
     * @apiSuccess {Number} user_id 创建用户id
     * @apiSuccess {Date}   created_at 创建时间
     * @apiSuccess {Date}   updated_at 更新时间
     * @apiSuccess {Date}   deleted_at 删除时间
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
     *
     */
    public function getUserCourses()
    {
        $courses = Auth::user()->courses;

        return $this->ajaxResponse(0, '操作成功', compact('courses'));
    }

    /**
     * @api {get} user/apply/actives 获取用户参与的活动
     * @apiName getUserApplyActives
     * @apiGroup User
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
     *
     */
    public function getUserApplyActives()
    {
        $actives = Auth::user()->applyActives;

        return $this->ajaxResponse(0, '操作成功', compact('actives'));
    }

    /**
     * @api {get} user/apply/courses 获取用户参与的课程
     * @apiName getUserApplyCourses
     * @apiGroup User
     *
     * @apiSuccess {Number} id 课程id
     * @apiSuccess {Number} number 课程号
     * @apiSuccess {String} name 课程名称
     * @apiSuccess {String} teacher 主讲教师
     * @apiSuccess {Number} user_id 创建用户id
     * @apiSuccess {Date}   created_at 创建时间
     * @apiSuccess {Date}   updated_at 更新时间
     * @apiSuccess {Date}   deleted_at 删除时间
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
    public function getUserAppplyCourses()
    {
        $courses = Auth::user()->applyCourses;

        return $this->ajaxResponse(0, '操作成功', compact('courses'));
    }

    /**
     * @api {get} user/publish/actives 获取用户发布的活动
     * @apiName getUserPublishActives
     * @apiGroup User
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
     */
    public function getUserPublishActives()
    {
        $actives = Auth::user()->actives;

        return $this->ajaxResponse(0, '操作成功', compact('actives'));
    }
}
