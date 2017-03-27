<?php

namespace App\Http\Controllers\Index;

use App\Model\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function getCourseList()
    {
        $courses = Course::all();

        return $this->ajaxResponse(0, '操作成功', compact('courses'));
    }

    public function getCourseDetail(Course $course)
    {
        return $this->ajaxResponse(0, '操作成功', compact('course'));
    }

    public function getApplyUsers(Course $course)
    {
        $users = $course->users;


    }
}
