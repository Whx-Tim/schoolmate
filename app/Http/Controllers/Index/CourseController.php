<?php

namespace App\Http\Controllers\Index;

use App\Http\Requests\StoreCourseRequest;
use App\Model\Course;
use App\Model\CourseGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    /**
     * 获取课程列表
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCourseList()
    {
        $courses = Course::all();

        return $this->ajaxResponse(0, '操作成功', compact('courses'));
    }

    /**
     * 获取课程详情
     *
     * @param Course $course
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCourseDetail(Course $course)
    {
        return $this->ajaxResponse(0, '操作成功', compact('course'));
    }

    /**
     * 获取参与课程用户
     *
     * @param Course $course
     * @return \Illuminate\Http\JsonResponse
     */
    public function getApplyUsers(Course $course)
    {
        $users = $course->users;

        return $this->ajaxResponse(0, '操作成功', compact('users'));
    }

    /**
     * 创建课程
     *
     * @param StoreCourseRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeCourse(StoreCourseRequest $request)
    {
        try {
            $course = Course::create($request->except(['_method','_token']));
        } catch (\Exception $e) {
            Log::info('创建课程异常：'.$e);

            return $this->ajaxResponse(1, '操作失败');
        }

        return $this->ajaxResponse(0, '操作成功', compact('course'));
    }

    /**
     * 参与课程
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function applyCourse(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'course_id' => 'required'
        ], [
            'user_id.required' => '用户id不存在',
            'course_id.required' => '课程id不存在'
        ]);

        try {
            CourseGroup::create($request->only(['user_id','course_id']));
        } catch (\Exception $e) {
            Log::info('参与课程异常：'. $e);

            return $this->ajaxResponse(1, '参与课程失败');
        }

        return $this->ajaxResponse(0, '加入成功');
    }
}
