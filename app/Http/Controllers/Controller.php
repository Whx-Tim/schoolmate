<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\ExtendModel as Model;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ajaxResponse($errcode = 0, $errmsg = '', $data = [])
    {
        return response()->json([
            'errcode' => $errcode,
            'errmsg'  => $errmsg,
            'data'    => $data
        ]);
    }

    public function getListOrderByDesc(Model $model, Request $request)
    {
        return empty($request->get('per_page')) ? $model->getListOrderByDesc($request->get('condition')) : $model->getListOrderByDesc($request->get('condition'), $request->get('per_page'));
    }

    public function __construct()
    {
//        Auth::loginUsingId(41);
//        if (!Auth::check()) {
//            return response('请登录系统',403);
//        }
    }

    public function canPublish($model)
    {
        if ($model->user->id == Auth::id()) {
            return 1;
        } else {
            return 0;
        }
    }
}
