<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show()
    {
        $users = User::orderBy('created_at','desc')->paginate();
        $count = $users->total();

        return view('admin.user.list', compact('users', 'count'));
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function detail(User $user)
    {
        return view('admin.user.detail', compact('user'));
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
        $user->update($request->only(['']))
    }

}
