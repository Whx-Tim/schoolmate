<?php

namespace App\Http\Controllers\Index;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUserInfo(User $user)
    {
        $userInfo = $user->info;

        return $this->ajaxResponse(0, '操作成功', compact('userInfo'));
    }

    public function getAuthUserId()
    {
        return $this->ajaxResponse(0, '操作成功', ['id' => Auth::user()->id]);
    }
}
