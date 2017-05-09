<?php

namespace App\Http\Controllers\Admin;

use App\Model\Active;
use App\Model\Announcement;
use App\Model\Comment;
use App\Model\Course;
use App\Model\Good;
use App\Model\League;
use App\Model\Message;
use App\Model\Partime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatisticsController extends Controller
{
    //

    public function index()
    {
        $day_actives = Active::whereDay('created_at',Carbon::now()->day)->count();
        $month_actives = Active::whereMonth('created_at', Carbon::now()->month)->count();
        $actives = Active::count();
        for ($i=7; $i >= 0;$i--) {
            $prev_day_active[$i] = [
                'count' => Active::whereDay('created_at',Carbon::now()->subDays($i)->day)->count(),
                'index' => Carbon::now()->subDays($i)->day
            ];
        }
        for ($i=11; $i >= 0;$i--) {
            $prev_month_active[$i] = [
                'count' => Active::whereMonth('created_at',Carbon::now()->subMonths($i)->month)->count(),
                'index' => Carbon::now()->subMonths($i)->month
            ];
        }
        
        $day_courses = Course::whereDay('created_at',Carbon::now()->day)->count();
        $month_courses = Course::whereMonth('created_at', Carbon::now()->month)->count();
        $courses = Course::count();
        for ($i=7; $i >= 0;$i--) {
            $prev_day_course[$i] = [
                'count' => Course::whereDay('created_at',Carbon::now()->subDays($i)->day)->count(),
                'index' => Carbon::now()->subDays($i)->day
            ];
        }
        for ($i=11; $i >= 0;$i--) {
            $prev_month_course[$i] = [
                'count' => Course::whereMonth('created_at',Carbon::now()->subMonths($i)->month)->count(),
                'index' => Carbon::now()->subMonths($i)->month
            ];
        }

        $day_leagues = League::whereDay('created_at',Carbon::now()->day)->count();
        $month_leagues = League::whereMonth('created_at', Carbon::now()->month)->count();
        $leagues = League::count();
        for ($i=7; $i >= 0;$i--) {
            $prev_day_league[$i] = [
                'count' => League::whereDay('created_at',Carbon::now()->subDays($i)->day)->count(),
                'index' => Carbon::now()->subDays($i)->day
            ];
        }
        for ($i=11; $i >= 0;$i--) {
            $prev_month_league[$i] = [
                'count' => League::whereMonth('created_at',Carbon::now()->subMonths($i)->month)->count(),
                'index' => Carbon::now()->subMonths($i)->month
            ];
        }

        $day_announcements = Announcement::whereDay('created_at',Carbon::now()->day)->count();
        $month_announcements = Announcement::whereMonth('created_at', Carbon::now()->month)->count();
        $announcements = Announcement::count();
        for ($i=7; $i >= 0;$i--) {
            $prev_day_announcement[$i] = [
                'count' => Announcement::whereDay('created_at',Carbon::now()->subDays($i)->day)->count(),
                'index' => Carbon::now()->subDays($i)->day
            ];
        }
        for ($i=11; $i >= 0;$i--) {
            $prev_month_announcement[$i] = [
                'count' => Announcement::whereMonth('created_at',Carbon::now()->subMonths($i)->month)->count(),
                'index' => Carbon::now()->subMonths($i)->month
            ];
        }

        $day_goods = Good::whereDay('created_at',Carbon::now()->day)->count();
        $month_goods = Good::whereMonth('created_at', Carbon::now()->month)->count();
        $goods = Good::count();
        for ($i=7; $i >= 0;$i--) {
            $prev_day_good[$i] = [
                'count' => Good::whereDay('created_at',Carbon::now()->subDays($i)->day)->count(),
                'index' => Carbon::now()->subDays($i)->day
            ];
        }
        for ($i=11; $i >= 0;$i--) {
            $prev_month_good[$i] = [
                'count' => Good::whereMonth('created_at',Carbon::now()->subMonths($i)->month)->count(),
                'index' => Carbon::now()->subMonths($i)->month
            ];
        }

        $day_messages = Message::whereDay('created_at',Carbon::now()->day)->count();
        $month_messages = Message::whereMonth('created_at', Carbon::now()->month)->count();
        $messages = Message::count();
        for ($i=7; $i >= 0;$i--) {
            $prev_day_message[$i] = [
                'count' => Message::whereDay('created_at',Carbon::now()->subDays($i)->day)->count(),
                'index' => Carbon::now()->subDays($i)->day
            ];
        }
        for ($i=11; $i >= 0;$i--) {
            $prev_month_message[$i] = [
                'count' => Message::whereMonth('created_at',Carbon::now()->subMonths($i)->month)->count(),
                'index' => Carbon::now()->subMonths($i)->month
            ];
        }

        $day_comments = Comment::whereDay('created_at',Carbon::now()->day)->count();
        $month_comments = Comment::whereMonth('created_at', Carbon::now()->month)->count();
        $comments = Comment::count();
        for ($i=7; $i >= 0;$i--) {
            $prev_day_comment[$i] = [
                'count' => Comment::whereDay('created_at',Carbon::now()->subDays($i)->day)->count(),
                'index' => Carbon::now()->subDays($i)->day
            ];
        }
        for ($i=11; $i >= 0;$i--) {
            $prev_month_comment[$i] = [
                'count' => Comment::whereMonth('created_at',Carbon::now()->subMonths($i)->month)->count(),
                'index' => Carbon::now()->subMonths($i)->month
            ];
        }

        $day_infos = Partime::whereDay('created_at',Carbon::now()->day)->count();
        $month_infos = Partime::whereMonth('created_at', Carbon::now()->month)->count();
        $infos = Partime::count();
        for ($i=7; $i >= 0;$i--) {
            $prev_day_info[$i] = [
                'count' => Partime::whereDay('created_at',Carbon::now()->subDays($i)->day)->count(),
                'index' => Carbon::now()->subDays($i)->day
            ];
        }
        for ($i=11; $i >= 0;$i--) {
            $prev_month_info[$i] = [
                'count' => Partime::whereMonth('created_at',Carbon::now()->subMonths($i)->month)->count(),
                'index' => Carbon::now()->subMonths($i)->month
            ];
        }
        return view('admin.statistics.index', compact(
            'day_actives',
            'month_actives',
            'actives',
            'prev_day_active',
            'prev_month_active',
            'day_courses',
            'month_courses',
            'courses',
            'prev_day_course',
            'prev_month_course',
            'day_leagues',
            'month_leagues',
            'leagues',
            'prev_day_league',
            'prev_month_league',
            'day_announcements',
            'month_announcements',
            'announcements',
            'prev_day_announcement',
            'prev_month_announcement',
            'day_goods',
            'month_goods',
            'goods',
            'prev_day_good',
            'prev_month_good',
            'day_messages',
            'month_messages',
            'messages',
            'prev_day_message',
            'prev_month_message',
            'day_comments',
            'month_comments',
            'comments',
            'prev_day_comment',
            'prev_month_comment',
            'day_infos',
            'month_infos',
            'infos',
            'prev_day_info',
            'prev_month_info'
        ));
    }
}
