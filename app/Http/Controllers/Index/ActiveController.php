<?php

namespace App\Http\Controllers\Index;

use App\Http\Requests\StoreActiveRequest;
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
     * @api {get} active/getActive/{id} 获取活动详情
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
     * @apiParam {String} lnt 经度
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
            $active = Active::create($request->except(['_method','_token']));
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
     * @apiParam {String} lnt 经度
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
                'user_id' => Auth::user()->id,
                'active_id' => $active
            ]);
        } catch (\Exception $exception) {
            Log::info('参与活动异常：'.$exception);

            return $this->ajaxResponse(1, '参与活动失败');
        }

        return $this->ajaxResponse(0, '参与成功');
    }
}
