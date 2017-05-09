<?php

namespace App\Http\Controllers\Admin;

use App\Events\Created;
use App\Http\Requests\FactoryAmountRequest;
use App\Model\Active;
use App\Model\ActiveApply;
use App\Model\Announcement;
use App\Model\Course;
use App\Model\CourseGroup;
use App\Model\Good;
use App\Model\League;
use App\Model\LeagueGroup;
use App\Model\UserInfo;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public function index()
    {
        return view('admin.data.index');
    }

    public function userFactory(FactoryAmountRequest $request)
    {
        $amount = $request->input('amount');
        UserInfo::insert(factory(UserInfo::class)->times($amount)->make()->toArray());

        return $this->ajaxResponse(0, '已生成'.$amount.'条用户数据');
    }

    public function activeFactory(FactoryAmountRequest $request)
    {
        $amount = $request->input('amount');
        Active::insert(factory(Active::class)->times($amount)->make()->toArray());
        ActiveApply::insert(factory(ActiveApply::class)->times($amount)->make()->toArray());

        return $this->ajaxResponse(0, '已生成'.$amount.'条活动数据');
    }

    public function courseFactory(FactoryAmountRequest $request)
    {
        $amount = $request->input('amount');
        Course::insert(factory(Course::class)->times($amount)->make()->toArray());
        CourseGroup::insert(factory(CourseGroup::class)->times($amount)->make()->toArray());

        return $this->ajaxResponse(0, '已生成'.$amount.'条课程数据');
    }

    public function leagueFactory(FactoryAmountRequest $request)
    {
        $amount = $request->input('amount');
        League::insert(factory(League::class)->times($amount)->make()->toArray());
        LeagueGroup::insert(factory(LeagueGroup::class)->times($amount)->make()->toArray());

        return $this->ajaxResponse(0, '已生成'.$amount.'条社团数据');
    }

    public function goodFactory(FactoryAmountRequest $request)
    {
        $amount = $request->input('amount');
        Good::insert(factory(Good::class)->times($amount)->make()->toArray());

        return $this->ajaxResponse(0, '已生成'.$amount.'条商品数据');
    }

    public function announcementFactory(FactoryAmountRequest $request)
    {
        $amount = $request->input('amount');
        Announcement::insert(factory(Announcement::class)->times($amount)->make()->toArray());

        return $this->ajaxResponse(0, '已生成'.$amount.'条公告数据');
    }
}
