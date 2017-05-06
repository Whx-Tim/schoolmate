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

    public function store()
    {

    }

    public function update(Request $request, User $user)
    {

    }

}
