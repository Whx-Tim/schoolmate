<?php

namespace App\Http\Controllers\Admin;

use App\Events\ViewPage;
use App\Http\Requests\StoreAnnouncementRequest;
use App\Model\Announcement;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnnouncementController extends Controller
{
    public function show()
    {
        $announcements = Announcement::with('view')->orderBy('created_at', 'desc')->paginate();
//        dd($announcements->toArray());
        $count = $announcements->total();

        return view('admin.announcement.list', compact('announcements', 'count'));
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcement.edit', compact('announcement'));
    }

    public function add()
    {
        return view('admin.announcement.add');
    }

    public function detail(Announcement $announcement)
    {
//        event(new ViewPage($announcement));

        return view('admin.announcement.detail', compact('announcement'));
    }

    public function update(Announcement $announcement, StoreAnnouncementRequest $request)
    {
        return $announcement->update($request->except(['_token', '_method'])) ? $this->ajaxResponse(0, '更新成功') : $this->ajaxResponse(1, '更新失败');
    }

    public function store(StoreAnnouncementRequest $request)
    {
        $announcement = Auth::user()->announcements()->create($request->except(['_token', '_method']));

        return $this->ajaxResponse(0, '添加成功', compact('announcement'));
    }

    public function delete(Announcement $announcement)
    {
        return $announcement->delete() ? $this->ajaxResponse(0, '删除成功') : $this->ajaxResponse(1, '删除失败');
    }
}
