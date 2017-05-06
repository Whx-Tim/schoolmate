<?php

namespace App\Http\Controllers\Index;

use App\Http\Requests\StoreAnnouncementRequest;
use App\Http\Requests\StoreCourseRequest;
use App\Model\Course;
use App\Model\CourseGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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
     * @apiSuccess {Number=0,1} can_publish 是否可以发送课程公告 0：不可以，1：可以
     * @apiSuccess {Bool}   applied 是否已参与
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
        $course->view()->increment('count');
        $can_publish = $this->canPublish($course);
        $applied = CourseGroup::where([
            'course_id' => $course->id,
            'user_id'   => Auth::id()
        ])->first() ? true : false;
        $hasSign = Cache::has('course_map_'.$course->id) ? true : false;
        return $this->ajaxResponse(0, '操作成功', compact('course', 'can_publish', 'applied', 'hasSign'));
    }

    /**
     * @api {get} course/applyCourseUsers/{course_id} 获取参与course_id课程的用户信息
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
     * @apiSuccess {Number} number 课程号
     * @apiSuccess {String} name 课程名称
     * @apiSuccess {String} teacher 主讲教师
     * @apiSuccess {Number} invite_code 邀请码
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
    public function storeCourse(StoreCourseRequest $request)
    {
        try {
            $request = $request->except(['_method', '_token']);
            $request['user_id'] = Auth::id();
            $course = Course::create($request);
            $this->applyCourse($course->id);
            $invite_code = random_int(1000, 9999);
            Cache::put('course_invite_'.$invite_code, $course, 10);
        } catch (\Exception $e) {
            Log::info('创建课程异常：'.$e);

            return $this->ajaxResponse(1, '操作失败');
        }

        return $this->ajaxResponse(0, '操作成功', compact('course','invite_code'));
    }

    /**
     * @api {get} course/apply/{course_id} 参与课程
     * @apiName applyCourse
     * @apiGroup Course
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "加入成功",
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

    /**
     * @api {get} course/invite/{code} 根据邀请码获取课程信息
     * @apiName getCourseInfoFromInviteCode
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
     *         "errmsg": "操作成功",
     *         "data": {
     *         }
     *     }
     */
    public function inviteCodeGetCourse($code)
    {
        if (Cache::has('course_invite_'.$code)) {
            $course = Cache::get('course_invite_'.$code);
        } else {
            return $this->ajaxResponse(2, '邀请码已过期');
        }

        return $this->ajaxResponse(0, '操作成功', compact('course'));
    }

    /**
     * @api {post} course/info/publish/{course_id} 发布课程公告
     * @apiName publishAnnouncement
     * @apiGroup Course
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
    public function publishAnnouncement(Course $course, StoreAnnouncementRequest $request)
    {
        if ($course->user->id == Auth::id()) {
            $announcement = $course->announcements()->create($request->except(['_token', '_method']));
        } else {
            return $this->ajaxResponse(2, '你没有权限发布该课程公告');
        }

        return $this->ajaxResponse(0, '发布成功', $announcement);
    }

    /**
     * @api {get} course/file/list/{course_id} 获取课程资源列表
     * @apiName getCourseFile
     * @apiGroup Course
     *
     * @apiSuccess {Number} id 文件id
     * @apiSuccess {String} name 文件名称
     * @apiSuccess {String} path 文件路径
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
    public function fileList(Course $course,Request $request)
    {
        $files = $course->files()->paginate($request->get('per_page'));

        return $this->ajaxResponse(0, '操作成功', compact('files'));
    }

    /**
     * @api {post} course/upload/{course_id} 上传文件
     * @apiName uploadFile
     * @apiGroup Course
     *
     * @apiParam {File} file 文件
     *
     * @apiSuccess {String} file_path 文件路径
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
    public function fileUpload(Request $request,Course $course)
    {
        $this->validate($request, [
            'file' => 'required|file',
        ], [
            'file.required' => '请上传文件',
            'file.file'     => '上传的不是文件'
        ]);
        $file = $request->file('file');
        $name = time().'_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/files/'), $name);
        $file_path = '/uploads/files/'.$name;
        $course->files()->create(['path' => $file_path,'name' => $file->getClientOriginalName()]);
        try {

        } catch (\Exception $exception) {
            Log::info('上传文件异常:' .$exception);

            return $this->ajaxResponse(1, '上传失败');
        }


        return $this->ajaxResponse(0 , '上传成功', compact('file_path'));
    }

    /**
     * @api {post} course/initiate/sign/{course_id} 课程发起签到
     * @apiName initiateSign
     * @apiGroup Course
     *
     * @apiParam {Float} lng 经度
     * @apiParam {Float} lat 纬度
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "发起成功",
     *         "data": {
     *         }
     *     }
     */
    public function initiateSign($id, Request $request)
    {
       $this->validate($request, [
           'lng' => 'required',
           'lat' => 'required'
       ], [
           'lng.required' => '请发送经度',
           'lat.required' => '请发送纬度'
       ]);

       Cache::put('course_map_'.$id, $request->only(['lng', 'lat']), 1);

       return $this->ajaxResponse(0, '发起成功');
    }

    /**
     * @api {post} course/sign/{course_id} 课程签到
     * @apiName courseSign
     * @apiGroup Course
     *
     * @apiParam {Float} lng 经度
     * @apiParam {Float} lat 纬度
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "发起成功",
     *         "data": {
     *         }
     *     }
     *
     * @apiErrorExample Error-Response:
     * HTTP/1.1 200 OK
     *     {
     *         "errcode": 1,
     *         "errmsg": "签到已过期",
     *         "data": {
     *         }
     *     }
     * @apiErrorExample Error-Response:
     * HTTP/1.1 200 OK
     *     {
     *         "errcode": 2,
     *         "errmsg": "签到距离大于20米，签到失败",
     *         "data": {
     *         }
     *     }
     */
    public function courseSign($id, Request $request)
    {
        $this->validate($request, [
            'lng' => 'required',
            'lat' => 'required'
        ], [
            'lng.required' => '请发送经度',
            'lat.required' => '请发送纬度'
        ]);

        if (Cache::has('course_map_'.$id)) {
            $map = Cache::get('course_map_'.$id);
            $distance = $this->getDistance($map['lng'], $map['lat'], $request->input('lng'), $request->input('lat'));
            if ($distance > 20) {
                return $this->ajaxResponse(2, '签到距离大于20米，签到失败');
            } else {
                return $this->ajaxResponse(0, '签到成功');
            }
        } else {
            return $this->ajaxResponse(1, '签到已过期');
        }
    }

    protected function getDistance($lng1, $lat1, $lng2, $lat2)
    {
        $earthRadius = 6367000; //approximate radius of earth in meters
        $lat1 = ($lat1 * pi() ) / 180;
        $lng1 = ($lng1 * pi() ) / 180;
        $lat2 = ($lat2 * pi() ) / 180;
        $lng2 = ($lng2 * pi() ) / 180;
        $calcLongitude = $lng2 - $lng1;
        $calcLatitude = $lat2 - $lat1;
        $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
        $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
        $calculatedDistance = $earthRadius * $stepTwo;
        return round($calculatedDistance);
    }

}
