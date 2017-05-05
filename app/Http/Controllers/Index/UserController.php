<?php

namespace App\Http\Controllers\Index;

use App\Events\UserRegister;
use App\Http\Requests\UserRegisterRequest;
use App\Model\Active;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

        return $this->ajaxResponse(0, '操作成功', compact('userInfo','user'));
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
        if (Auth::check()) {
            return $this->ajaxResponse(0, '操作成功', ['id' => Auth::user()->id]);
        } else {
            return $this->ajaxResponse(1, '请先登录');
        }

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
        User::where('id',Auth::id())->update($request->except(['_token','_method','id']));
        try {

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
     * @api {get} user/goods 获取用户发布过的商品
     * @apiName getUserGoods
     * @apiGroup User
     *
     * @apiSuccess {Number} id 商品id
     * @apiSuccess {String} shopName 商品名称
     * @apiSuccess {String} shopType 商品类型
     * @apiSuccess {Float}  shopPrice 商品价格
     * @apiSuccess {Number} shopNumber 商品数量
     * @apiSuccess {String} shopPicture 商品图片
     * @apiSuccess {String} shopDescription 商品描述
     * @apiSuccess {String} status 商品状态
     * @apiSuccess {Number=1，0} authChoice 是否显示商家信息
     * @apiSuccess {Number} user_id 用户id
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
    public function getUserGoods()
    {
        $goods = Auth::user()->goods;

        return $this->ajaxResponse(0, '操作成功', compact('goods'));
    }

    /**
     * @api {get} user/leagues 获取用户创建过的社团
     * @apiName getUserLeagues
     * @apiGroup User
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
     */
    public function getUserLeagues()
    {
        $leagues = Auth::user()->leagues;

        return $this->ajaxResponse(0, '操作成功', compact('leagues'));
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
    public function getUserApplyCourses()
    {
        $courses = Auth::user()->applyCourses;

        return $this->ajaxResponse(0, '操作成功', compact('courses'));
    }

    /**
     * @api {get} user/apply/leagues 获取用户参与的社团
     * @apiName getUserApplyLeagues
     * @apiGroup User
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
     */
    public function getUserApplyLeagues()
    {
        $leagues = Auth::user()->applyLeagues;

        return $this->ajaxResponse(0, '操作成功', compact('leagues'));
    }

    /**
     * @api {post} user/register 用户注册
     * @apiName userRegister
     * @apiGroup User
     *
     * @apiParam {String} username 用户名
     * @apiParam {String} password 密码
     * @apiParam {String} password_confirmation 确认密码
     * @apiParam {String} email 邮箱
     *
     * @apiSuccess {Number} id 用户id
     * @apiSuccess {String} username 用户名
     * @apiSuccess {String} password 密码
     * @apiSuccess {String} password_confirmation 确认密码
     * @apiSuccess {String} email 邮箱
     * @apiSuccess {Number=0，1} is_active 是否激活，0：未激活，1：已激活
     * @apiSuccess {Date}   created_at 创建时间
     * @apiSuccess {Date}   updated_at 更新时间
     * @apiSuccess {Date}   deleted_at 删除时间
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "注册成功，请赶紧激活您的邮箱吧~~",
     *         "data": {
     *         }
     *     }
     */
    public function register(UserRegisterRequest $request)
    {
        $user = User::create([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'email'    => $request->input('email')
        ]);
        event(new UserRegister($user->id,$user->email));

        return $this->ajaxResponse(0 , '注册成功，请赶紧激活您的邮箱吧~~', compact('user'));
    }

    /**
     * @api {get} user/fire/{code} 激活用户
     * @apiName fireUser
     * @apiGroup User
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "激活成功",
     *         "data": {
     *         }
     *     }
     *
     */
    public function fireUser($code)
    {
        if (Cache::has($code)) {
            $id = Cache::pull($code);
            User::where('id', $id)->update(['is_active' => 1]);
            return $this->ajaxResponse(0, '激活成功');
        } else {
            return $this->ajaxResponse(1, '激活码已过期');
        }
    }

    /**
     * @api {get} user/sendActivationCode 重新激活账号
     * @apiName sendActivationCode
     * @apiGroup User
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "发送成功，快去激活你的账号吧~",
     *         "data": {
     *         }
     *     }
     *
     */
    public function sendActivationCode()
    {
        $user = Auth::user();
        event(new UserRegister($user->id, $user->email));

        return $this->ajaxResponse(0, '发送成功，快去激活你的账号吧~');
    }

    /**
     * @api {post} user/login 登录
     * @apiName UserLogin
     * @apiGroup User
     *
     * @apiParam {String} username 用户名或者邮箱
     * @apiParam {String} password 密码
     *
     * @apiSuccess {Number} id 用户id
     * @apiSuccess {String} username 用户名
     * @apiSuccess {String} password 密码
     * @apiSuccess {String} password_confirmation 确认密码
     * @apiSuccess {String} email 邮箱
     * @apiSuccess {Number=0，1} is_active 是否激活，0：未激活，1：已激活
     * @apiSuccess {Date}   created_at 创建时间
     * @apiSuccess {Date}   updated_at 更新时间
     * @apiSuccess {Date}   deleted_at 删除时间
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "登录成功",
     *         "data": {
     *         }
     *     }
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => '请输入用户名',
            'password.required' => '请输入密码'
        ]);

        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password'), 'is_active' => 1]) || Auth::attempt(['email' => $request->input('username'), 'password' => $request->input('password'), 'is_active' => 1])) {
            $user = Auth::user();
            return $this->ajaxResponse(0, '登录成功', compact('user'));
        } else {
            $user = User::where('username', $request->input('username'))->orWhere('email', $request->input('username'))->first();
            if ($user) {
                event(new UserRegister($user->id, $user->email));

                return $this->ajaxResponse(0, '登录成功，请激活您的账号');
            }
            return $this->ajaxResponse(2, '该账号还未注册');
        }
    }

    /**
     * @api {get} user/logout 注销
     * @apiName userLogout
     * @apiGroup User
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "注销成功",
     *         "data": {
     *         }
     *     }
     */
    public function logout()
    {
        Auth::logout();

        return $this->ajaxResponse(0, '注销成功');
    }

    /**
     * @api {post} user/upload/avatar 更新用户头像
     * @apiName updateUserAvatar
     * @apiGroup User
     *
     * @apiParam {File} image 用户头像图片
     *
     * @apiSuccess {String} path 头像路径
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
    public function uploadAvatar(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image'
        ], [
            'image.required' => '上传文件不可为空',
            'image.image'    => '上传的必须是图片'
        ]);

        $file = $request->file('image');
        $name = time().'_'.str_random(5).'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads/images'), $name);
        $path = '/uploads/images/'.$name;
        Auth::user()->info()->update(['wx_head_img' => $path]);

        return $this->ajaxResponse(0, '上传成功', compact('path'));
    }

}
