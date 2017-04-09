<?php

namespace App\Http\Controllers\Index;

use App\Http\Requests\StoreCourseRequest;
use App\Model\Course;
use App\Model\CourseGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    /**
     * @api {get} course/list 获取课程列表
     * @apiName getCourseList
     * @apiGroup Course
     *
     * @apiParam {Number=0} page 当前页码
     * @apiParam {Number=10} per_page
     *
     * @apiSuccess {Number} id 课程id
     * @apiSuccess {Number} number 课程号
     * @apiSuccess {String} name 课程名称
     * @apiSuccess {String} teacher 主讲教师
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
     */
    public function getCourseList(Request $request)
    {
        $courses = $this->getListOrderByDesc(new Course(), $request);

        return $this->ajaxResponse(0, '操作成功', compact('courses'));
    }

    /**
     * @api {get} course/detail/{course_id} 获取课程详情
     * @apiName getCourseDetail
     * @apiGroup Course
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
    public function getCourseDetail(Course $course)
    {
        return $this->ajaxResponse(0, '操作成功', compact('course'));
    }

    /**
     * @api {get} active/applyCourseUsers/{course_id} 获取参与active_id活动的用户信息
     * @apiName getApplyCourseUsers
     * @apiGroup Course
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
    public function getApplyUsers(Course $course)
    {
        $users = $course->users;
        $users = $users->map(function ($item, $key) {
            return $item->info;
        });

        return $this->ajaxResponse(0, '操作成功', compact('users'));
    }

    /**
     * @api {post} course/store 创建课程
     * @apiName storeCourse
     * @apiGroup Course
     *
     * @apiParam {Number} number 课程号
     * @apiParam {String} name 课程名称
     * @apiParam {String} teacher 主讲教师
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
    public function storeCourse(StoreCourseRequest $request)
    {
        try {
            $request = $request->except(['_method', '_token']);
            $request['user_id'] = Auth::id();
            $course = Course::create($request);
        } catch (\Exception $e) {
            Log::info('创建课程异常：'.$e);

            return $this->ajaxResponse(1, '操作失败');
        }

        return $this->ajaxResponse(0, '操作成功', compact('course'));
    }

    /**
     * @api {get} course/apply/{course_id}
     * @apiName applyCourse
     * @apiGroup Course
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
    public function applyCourse($course)
    {
        try {
            $data['user_id'] = Auth::id();
            $data['course_id'] = $course;
            CourseGroup::create($data);
        } catch (\Exception $e) {
            Log::info('参与课程异常：'. $e);

            return $this->ajaxResponse(1, '参与课程失败');
        }

        return $this->ajaxResponse(0, '加入成功');
    }
}
