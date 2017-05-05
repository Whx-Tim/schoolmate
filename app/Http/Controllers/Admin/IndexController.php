<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

    public function show()
    {
        return view('admin.index');
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'image'
        ], [
            'file.image' => '请上传图片类型的文件'
        ]);

        $file = $request->file('file');
        $name = time().'_'.str_random(5).'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads/images/'), $name);
        $path = '/uploads/images/'.$name;

        return $this->ajaxResponse(0, '上传成功', compact('path'));
    }
}
