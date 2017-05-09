<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreActiveRequest;
use App\Model\Active;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActiveController extends Controller
{
    public function show()
    {
        $actives = Active::paginate();
        $count = Active::count();

        return view('admin.active.list', compact('actives', 'count'));
    }

    public function detail(Active $active)
    {
        $applyCount = $active->users()->count();
        return view('admin.active.detail', compact('active','applyCount'));
    }

    public function edit(Active $active)
    {
        return view('admin.active.edit', compact('active'));
    }

    public function showStore()
    {
        return view('admin.active.add');
    }

    public function store(StoreActiveRequest $request)
    {
        $active = Active::create($request->except(['_token', '_method']));

        return $this->ajaxResponse(0, '创建成功', compact('active'));
    }

    public function update(StoreActiveRequest $request, Active $active)
    {
        $active->update($request->except(['_token', '_method']));

        return $this->ajaxResponse(0, '更新成功');
    }

    public function delete(Active $active)
    {
        return $active->delete() ? $this->ajaxResponse(0, '删除成功') : $this->ajaxResponse(1, '删除失败');
    }
}
