<?php

namespace App\Http\Controllers\Index;

use App\Model\Announcement;
use App\Model\Partime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InfoController extends Controller
{
    public function getAllList(Request $request)
    {
        $partime = $this->getListOrderByDesc(new Partime(), $request);
        $announcement = $this->getListOrderByDesc(new Announcement(), $request);



    }
}
