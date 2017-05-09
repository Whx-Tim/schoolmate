<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreLeagueRequest;
use App\Model\League;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeagueController extends Controller
{
    public function show()
    {
        $leagues = League::orderBy('created_at', 'desc')->paginate();
        $count = $leagues->total();

        return view('admin.league.list', compact('leagues', 'count'));
    }

    public function edit(League $league)
    {
        return view('admin.league.edit', compact('league'));
    }

    public function add()
    {
        return view('admin.league.add');
    }

    public function detail(League $league)
    {
        $applyCount = $league->users()->count();
        return view('admin.league.detail', compact('league','applyCount'));
    }

    public function store(StoreLeagueRequest $request)
    {
        League::create($request->except(['_token', '_method']));

        return $this->ajaxResponse(0, '添加成功');
    }

    public function update(StoreLeagueRequest $request, League $league)
    {
        return $league->update($request->except(['_token', '_method'])) ? $this->ajaxResponse(0, '更新成功') : $this->ajaxResponse(1, '更新失败');
    }

    public function delete(League $league)
    {
        return $league->delete() ? $this->ajaxResponse(0, '删除成功') : $this->ajaxResponse(1, '删除失败');
    }
}
