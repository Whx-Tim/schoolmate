<?php

namespace App\Http\Controllers\Index;

use App\Model\League;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeagueController extends Controller
{
    public function getList(Request $request)
    {
        $leagues = $this->getListOrderByDesc(new League(), $request);

        return $this->ajaxResponse(0, '操作成功', compact('leagues'));
    }

    public function getLeague(League $league)
    {
        return $this->ajaxResponse(0, '操作成功', compact('league'));
    }
}
