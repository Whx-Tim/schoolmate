<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StorePartimeRequest;
use App\Model\Partime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    public function index()
    {
        $infos = Partime::orderBy('created_at', 'desc')->paginate();
        $count = $infos->total();

        return view('admin.info.list',compact('infos', 'count'));
    }

    public function edit(Partime $partime)
    {
        $info = $partime;
        return view('admin.info.edit', compact('info'));
    }

    public function delete(Partime $partime)
    {
        return $partime->delete() ? $this->ajaxResponse(0, '删除成功') : $this->ajaxResponse(1, '删除失败');
    }

    public function add()
    {
        return view('admin.info.add');
    }

    public function detail(Partime $partime)
    {
        return view('admin.info.detail', ['info' => $partime]);
    }

    public function store(StorePartimeRequest $request)
    {
        Auth::user()->partimes()->create($request->except(['_token','_method']));

        return $this->ajaxResponse(0, '添加成功');
    }

    public function update(StorePartimeRequest $request, Partime $partime)
    {
        return $partime->update($request->except(['_token', '_method'])) ? $this->ajaxResponse(0, '更新成功') : $this->ajaxResponse(1, '更新失败');
    }
}
