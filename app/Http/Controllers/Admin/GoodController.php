<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreGoodRequest;
use App\Model\Good;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GoodController extends Controller
{
    public function show()
    {
        $goods = Good::orderBy('created_at', 'desc')->paginate();
        $count = $goods->total();

        return view('admin.good.list', compact('goods', 'count'));
    }

    public function edit(Good $good)
    {
        return view('admin.good.edit', compact('good'));
    }

    public function detail(Good $good)
    {
        return view('admin.good.detail', compact('good'));
    }

    public function add()
    {
        return view('admin.good.add');
    }

    public function store(StoreGoodRequest $request)
    {
        $good = Auth::user()->goods()->create($request->except(['_token', '_method']));

        return $this->ajaxResponse(0, '添加成功', compact('good'));
    }

    public function update(StoreGoodRequest $request, Good $good)
    {
        return $good->update($request->except(['_token', '_method'])) ? $this->ajaxResponse(0, '更新成功') : $this->ajaxResponse(1, '更新失败');
    }

    public function delete(Good $good)
    {
        return $good->delete() ? $this->ajaxResponse(0, '删除成功') : $this->ajaxResponse(1, '删除失败');
    }
}
