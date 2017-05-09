<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show()
    {
        $users = User::orderBy('created_at','desc')->with('info')->paginate();
        $count = $users->total();

        return view('admin.user.list', compact('users', 'count'));
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function detail(User $user)
    {
        $actives = $user->actives()->count();
        $apply_actives = $user->applyActives()->count();
        $courses = $user->courses()->count();
        $apply_courses = $user->applyCourses()->count();
        $leagues = $user->leagues()->count();
        $apply_leagues = $user->applyLeagues()->count();
        $comments = $user->comments()->count();
        $messages = $user->from_messages()->count();
        $goods    = $user->goods()->count();
        $active_infos = 0;
        $course_infos = 0;
        $league_infos = 0;
        $user->courses()->withCount('announcements')->get()->each(function ($course) use (&$course_infos) {
            $course_infos += $course->announcements_count;
        });
        $user->leagues()->withCount('announcements')->get()->each(function ($league) use (&$league_infos) {
            $league_infos += $league->announcements_count;
        });
        $user->actives()->withCount('announcements')->get()->each(function ($active) use (&$active_infos) {
            $active_infos += $active->announcements_count;
        });


        return view('admin.user.detail', compact('user','actives','apply_actives','courses','apply_courses','leagues','apply_leagues','comments','messages','goods','active_infos','course_infos','league_infos'));
    }

    public function add()
    {
        return view('admin.user.add');
    }

    public function delete(User $user) {
        $user->info()->delete();
        return $user->delete() ? $this->ajaxResponse(0, '删除成功') : $this->ajaxResponse(1, '删除失败');
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->only(['email', 'is_active']));
        $user->info()->update($request->except(['username','email', 'is_active', '_token', '_method']));

        return $this->ajaxResponse(0, '更新成功');
    }

}
