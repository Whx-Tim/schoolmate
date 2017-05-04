<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCourseRequest;
use App\Model\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function show()
    {
        $courses = Course::orderBy('created_at','desc')->paginate();
        $count = Course::count();

        return view('admin.course.list', compact('courses','count'));
    }

    public function add()
    {
        return view('admin.course.add');
    }

    public function edit(Course $course)
    {
        return view('admin.course.edit', compact('course'));
    }

    public function detail(Course $course)
    {
        return view('admin.course.detail', compact('course'));
    }

    public function delete(Course $course)
    {
        return $course->delete() ? $this->ajaxResponse(0, '删除成功') : $this->ajaxResponse(1, '删除异常');
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->except(['_token', '_method']));

        return $this->ajaxResponse(0, '添加成功');
    }

    public function update(StoreCourseRequest $request, Course $course)
    {
        return $course->update($request->except(['_token', '_method'])) ? $this->ajaxResponse(0, '更新成功') : $this->ajaxResponse(1, '更新失败');
    }
}
