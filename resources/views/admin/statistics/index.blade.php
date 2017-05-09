@extends('layouts.admin')

@section('admin.title', '数据统计')

@section('breadcrumb')
    <li class="active">数据统计</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#active" aria-controls="active" role="tab">活动数据统计</a></li>
                    <li role="presentation"><a href="#course" aria-controls="course" role="tab">课程数据统计</a></li>
                    <li role="presentation"><a href="#league" aria-controls="league" role="tab">社团数据统计</a></li>
                    <li role="presentation"><a href="#announcement" aria-controls="announcement" role="tab">公告数据统计</a></li>
                    <li role="presentation"><a href="#good" aria-controls="good" role="tab">商品数据统计</a></li>
                    <li role="presentation"><a href="#view" aria-controls="view" role="tab">访问量统计</a></li>
                    <li role="presentation"><a href="#message" aria-controls="message" role="tab">消息数据统计</a></li>
                    <li role="presentation"><a href="#comment" aria-controls="comment" role="tab">评论数据统计</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="active">
                        <div class="row">
                            <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $day_actives }}</p><span>今日发布量</span></div><div class="overview-icon"><i class="fa fa-envira"></i></div></div></div></div>
                            <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $month_actives }}</p><span>本月发布量</span></div><div class="overview-icon"><i class="fa fa-envira"></i></div></div></div></div>
                            <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $actives }}</p><span>总发布量</span></div><div class="overview-icon"><i class="fa fa-envira"></i></div></div></div></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-title">
                                        <h4 class="text-center">活动日发布统计图</h4>
                                    </div>
                                    <div class="panel-body" id="active-day" style="height: 600px;"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-title">
                                        <h4 class="text-center">活动月发布统计图</h4>
                                    </div>
                                    <div class="panel-body" id="active-month" style="height: 600px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="course">
                        <div class="row">
                            <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $day_courses }}</p><span>今日发布量</span></div><div class="overview-icon"><i class="fa fa-book"></i></div></div></div></div>
                            <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $month_courses }}</p><span>本月发布量</span></div><div class="overview-icon"><i class="fa fa-book"></i></div></div></div></div>
                            <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $courses }}</p><span>总发布量</span></div><div class="overview-icon"><i class="fa fa-book"></i></div></div></div></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-title">
                                        <h4 class="text-center">课程日发布统计图</h4>
                                    </div>
                                    <div class="panel-body" id="course-day" style="height: 600px;"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-title">
                                        <h4 class="text-center">课程月发布统计图</h4>
                                    </div>
                                    <div class="panel-body" id="course-month" style="height: 600px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="league">
                        <div class="row">
                            <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $day_leagues }}</p><span>今日发布量</span></div><div class="overview-icon"><i class="fa fa-users"></i></div></div></div></div>
                            <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $month_leagues }}</p><span>本月发布量</span></div><div class="overview-icon"><i class="fa fa-users"></i></div></div></div></div>
                            <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $leagues }}</p><span>总发布量</span></div><div class="overview-icon"><i class="fa fa-users"></i></div></div></div></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-title">
                                        <h4 class="text-center">社团日发布统计图</h4>
                                    </div>
                                    <div class="panel-body" id="league-day" style="height: 600px;"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-title">
                                        <h4 class="text-center">社团月发布统计图</h4>
                                    </div>
                                    <div class="panel-body" id="league-month" style="height: 600px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="announcement">
                        <div class="row">
                            <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $day_announcements }}</p><span>今日发布量</span></div><div class="overview-icon"><i class="fa fa-info-circle"></i></div></div></div></div>
                            <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $month_announcements }}</p><span>本月发布量</span></div><div class="overview-icon"><i class="fa fa-info-circle"></i></div></div></div></div>
                            <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $announcements }}</p><span>总发布量</span></div><div class="overview-icon"><i class="fa fa-info-circle"></i></div></div></div></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-title">
                                        <h4 class="text-center">公告日发布统计图</h4>
                                    </div>
                                    <div class="panel-body" id="announcement-day" style="height: 600px;"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-title">
                                        <h4 class="text-center">公告月发布统计图</h4>
                                    </div>
                                    <div class="panel-body" id="announcement-month" style="height: 600px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="good">
                        <div class="row">
                            <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $day_goods }}</p><span>今日发布量</span></div><div class="overview-icon"><i class="fa fa-shopping-basket"></i></div></div></div></div>
                            <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $month_goods }}</p><span>本月发布量</span></div><div class="overview-icon"><i class="fa fa-shopping-basket"></i></div></div></div></div>
                            <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $goods }}</p><span>总发布量</span></div><div class="overview-icon"><i class="fa fa-shopping-basket"></i></div></div></div></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-title">
                                        <h4 class="text-center">商品日发布统计图</h4>
                                    </div>
                                    <div class="panel-body" id="good-day" style="height: 600px;"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-title">
                                        <h4 class="text-center">商品月发布统计图</h4>
                                    </div>
                                    <div class="panel-body" id="good-month" style="height: 600px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="view">

                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="message">
                        <div class="row">
                            <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $day_messages }}</p><span>今日发布量</span></div><div class="overview-icon"><i class="fa fa-send"></i></div></div></div></div>
                            <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $month_messages }}</p><span>本月发布量</span></div><div class="overview-icon"><i class="fa fa-send"></i></div></div></div></div>
                            <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $messages }}</p><span>总发布量</span></div><div class="overview-icon"><i class="fa fa-send"></i></div></div></div></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-title">
                                        <h4 class="text-center">消息日发布统计图</h4>
                                    </div>
                                    <div class="panel-body" id="message-day" style="height: 600px;"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-title">
                                        <h4 class="text-center">消息月发布统计图</h4>
                                    </div>
                                    <div class="panel-body" id="message-month" style="height: 600px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="comment">
                        <div class="row">
                            <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $day_comments }}</p><span>今日发布量</span></div><div class="overview-icon"><i class="fa fa-comments"></i></div></div></div></div>
                            <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $month_comments }}</p><span>本月发布量</span></div><div class="overview-icon"><i class="fa fa-comments"></i></div></div></div></div>
                            <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $comments }}</p><span>总发布量</span></div><div class="overview-icon"><i class="fa fa-comments"></i></div></div></div></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-title">
                                        <h4 class="text-center">评论日发布统计图</h4>
                                    </div>
                                    <div class="panel-body" id="comment-day" style="height: 600px;"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-title">
                                        <h4 class="text-center">评论月发布统计图</h4>
                                    </div>
                                    <div class="panel-body" id="comment-month" style="height: 600px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('admin.scripts')
<script src="https://cdn.bootcss.com/echarts/3.5.4/echarts.min.js"></script>
<script>
    var optionActiveMonth = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                crossStyle: {
                    color: '#999'
                }
            }
        },
        toolbox: {
            feature: {
                dataView: {show: true, readOnly: false},
                magicType: {show: true, type: ['line', 'bar']},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        legend: {
            data:['活动发布量']
        },
        xAxis: [
            {
                type: 'category',
                data: [@foreach($prev_month_active as $month)'{{ $month['index'] }}',@endforeach],
                axisPointer: {
                    type: 'shadow'
                }
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: '活动发布量',
                min: 0,
                max: {{ $actives }},
                interval: 10
            }
        ],
        series: [
            {
                name:'活动发布量',
                type:'bar',
                data:[@foreach($prev_month_active as $month){{ $month['count'] }},@endforeach]
            },
            {
                name:'活动发布量',
                type:'line',
                data:[@foreach($prev_month_active as $month){{ $month['count'] }},@endforeach]
            }
        ]
    };
    var optionCourseMonth = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                crossStyle: {
                    color: '#999'
                }
            }
        },
        toolbox: {
            feature: {
                dataView: {show: true, readOnly: false},
                magicType: {show: true, type: ['line', 'bar']},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        legend: {
            data:['课程发布量']
        },
        xAxis: [
            {
                type: 'category',
                data: [@foreach($prev_month_course as $month)'{{ $month['index'] }}',@endforeach],
                axisPointer: {
                    type: 'shadow'
                }
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: '课程发布量',
                min: 0,
                max: {{ $courses }},
                interval: 10
            }
        ],
        series: [
            {
                name:'课程发布量',
                type:'bar',
                data:[@foreach($prev_month_course as $month){{ $month['count'] }},@endforeach]
            },
            {
                name:'活动发布量',
                type:'line',
                data:[@foreach($prev_month_course as $month){{ $month['count'] }},@endforeach]
            }
        ]
    };
    var optionLeagueMonth = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                crossStyle: {
                    color: '#999'
                }
            }
        },
        toolbox: {
            feature: {
                dataView: {show: true, readOnly: false},
                magicType: {show: true, type: ['line', 'bar']},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        legend: {
            data:['社团发布量']
        },
        xAxis: [
            {
                type: 'category',
                data: [@foreach($prev_month_league as $month)'{{ $month['index'] }}',@endforeach],
                axisPointer: {
                    type: 'shadow'
                }
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: '社团发布量',
                min: 0,
                max: {{ $leagues }},
                interval: 10
            }
        ],
        series: [
            {
                name:'社团发布量',
                type:'bar',
                data:[@foreach($prev_month_league as $month){{ $month['count'] }},@endforeach]
            },
            {
                name:'社团发布量',
                type:'line',
                data:[@foreach($prev_month_league as $month){{ $month['count'] }},@endforeach]
            }
        ]
    };
    var optionAnnouncementMonth = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                crossStyle: {
                    color: '#999'
                }
            }
        },
        toolbox: {
            feature: {
                dataView: {show: true, readOnly: false},
                magicType: {show: true, type: ['line', 'bar']},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        legend: {
            data:['公告发布量']
        },
        xAxis: [
            {
                type: 'category',
                data: [@foreach($prev_month_announcement as $month)'{{ $month['index'] }}',@endforeach],
                axisPointer: {
                    type: 'shadow'
                }
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: '公告发布量',
                min: 0,
                max: {{ $announcements }},
                interval: 10
            }
        ],
        series: [
            {
                name:'公告发布量',
                type:'bar',
                data:[@foreach($prev_month_announcement as $month){{ $month['count'] }},@endforeach]
            },
            {
                name:'公告发布量',
                type:'line',
                data:[@foreach($prev_month_announcement as $month){{ $month['count'] }},@endforeach]
            }
        ]
    };
    var optionGoodMonth = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                crossStyle: {
                    color: '#999'
                }
            }
        },
        toolbox: {
            feature: {
                dataView: {show: true, readOnly: false},
                magicType: {show: true, type: ['line', 'bar']},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        legend: {
            data:['商品发布量']
        },
        xAxis: [
            {
                type: 'category',
                data: [@foreach($prev_month_good as $month)'{{ $month['index'] }}',@endforeach],
                axisPointer: {
                    type: 'shadow'
                }
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: '商品发布量',
                min: 0,
                max: {{ $goods }},
                interval: 10
            }
        ],
        series: [
            {
                name:'商品发布量',
                type:'bar',
                data:[@foreach($prev_month_good as $month){{ $month['count'] }},@endforeach]
            },
            {
                name:'商品发布量',
                type:'line',
                data:[@foreach($prev_month_good as $month){{ $month['count'] }},@endforeach]
            }
        ]
    };
    var optionMessageMonth = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                crossStyle: {
                    color: '#999'
                }
            }
        },
        toolbox: {
            feature: {
                dataView: {show: true, readOnly: false},
                magicType: {show: true, type: ['line', 'bar']},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        legend: {
            data:['消息发布量']
        },
        xAxis: [
            {
                type: 'category',
                data: [@foreach($prev_month_message as $month)'{{ $month['index'] }}',@endforeach],
                axisPointer: {
                    type: 'shadow'
                }
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: '消息发布量',
                min: 0,
                max: {{ $messages }},
                interval: 10
            }
        ],
        series: [
            {
                name:'消息发布量',
                type:'bar',
                data:[@foreach($prev_month_message as $month){{ $month['count'] }},@endforeach]
            },
            {
                name:'消息发布量',
                type:'line',
                data:[@foreach($prev_month_message as $month){{ $month['count'] }},@endforeach]
            }
        ]
    };
    var optionCommentMonth = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                crossStyle: {
                    color: '#999'
                }
            }
        },
        toolbox: {
            feature: {
                dataView: {show: true, readOnly: false},
                magicType: {show: true, type: ['line', 'bar']},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        legend: {
            data:['评论发布量']
        },
        xAxis: [
            {
                type: 'category',
                data: [@foreach($prev_month_comment as $month)'{{ $month['index'] }}',@endforeach],
                axisPointer: {
                    type: 'shadow'
                }
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: '评论发布量',
                min: 0,
                max: {{ $comments }},
                interval: 10
            }
        ],
        series: [
            {
                name:'评论发布量',
                type:'bar',
                data:[@foreach($prev_month_comment as $month){{ $month['count'] }},@endforeach]
            },
            {
                name:'评论发布量',
                type:'line',
                data:[@foreach($prev_month_comment as $month){{ $month['count'] }},@endforeach]
            }
        ]
    };
    var optionActiveDay = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                crossStyle: {
                    color: '#999'
                }
            }
        },
        toolbox: {
            feature: {
                dataView: {show: true, readOnly: false},
                magicType: {show: true, type: ['line', 'bar']},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        legend: {
            data:['活动发布量']
        },
        xAxis: [
            {
                type: 'category',
                data: [@foreach($prev_day_active as $day)'{{ $day['index'] }}',@endforeach],
                axisPointer: {
                    type: 'shadow'
                }
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: '活动发布量',
                min: 0,
                max: {{ $actives }},
                interval: 10
            }
        ],
        series: [
            {
                name:'活动发布量',
                type:'bar',
                data:[@foreach($prev_day_active as $day){{ $day['count'] }},@endforeach]
            }
        ]
    };
    var optionCourseDay = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                crossStyle: {
                    color: '#999'
                }
            }
        },
        toolbox: {
            feature: {
                dataView: {show: true, readOnly: false},
                magicType: {show: true, type: ['line', 'bar']},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        legend: {
            data:['课程发布量']
        },
        xAxis: [
            {
                type: 'category',
                data: [@foreach($prev_day_course as $day)'{{ $day['index'] }}',@endforeach],
                axisPointer: {
                    type: 'shadow'
                }
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: '课程发布量',
                min: 0,
                max: {{ $courses }},
                interval: 10
            }
        ],
        series: [
            {
                name:'课程发布量',
                type:'bar',
                data:[@foreach($prev_day_course as $day){{ $day['count'] }},@endforeach]
            }
        ]
    };
    var optionLeagueDay = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                crossStyle: {
                    color: '#999'
                }
            }
        },
        toolbox: {
            feature: {
                dataView: {show: true, readOnly: false},
                magicType: {show: true, type: ['line', 'bar']},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        legend: {
            data:['社团发布量']
        },
        xAxis: [
            {
                type: 'category',
                data: [@foreach($prev_day_league as $day)'{{ $day['index'] }}',@endforeach],
                axisPointer: {
                    type: 'shadow'
                }
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: '社团发布量',
                min: 0,
                max: {{ $leagues }},
                interval: 10
            }
        ],
        series: [
            {
                name:'社团发布量',
                type:'bar',
                data:[@foreach($prev_day_league as $day){{ $day['count'] }},@endforeach]
            }
        ]
    };
    var optionGoodDay = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                crossStyle: {
                    color: '#999'
                }
            }
        },
        toolbox: {
            feature: {
                dataView: {show: true, readOnly: false},
                magicType: {show: true, type: ['line', 'bar']},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        legend: {
            data:['商品发布量']
        },
        xAxis: [
            {
                type: 'category',
                data: [@foreach($prev_day_good as $day)'{{ $day['index'] }}',@endforeach],
                axisPointer: {
                    type: 'shadow'
                }
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: '商品发布量',
                min: 0,
                max: {{ $goods }},
                interval: 10
            }
        ],
        series: [
            {
                name:'商品发布量',
                type:'bar',
                data:[@foreach($prev_day_good as $day){{ $day['count'] }},@endforeach]
            }
        ]
    };
    var optionMessageDay = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                crossStyle: {
                    color: '#999'
                }
            }
        },
        toolbox: {
            feature: {
                dataView: {show: true, readOnly: false},
                magicType: {show: true, type: ['line', 'bar']},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        legend: {
            data:['消息发布量']
        },
        xAxis: [
            {
                type: 'category',
                data: [@foreach($prev_day_message as $day)'{{ $day['index'] }}',@endforeach],
                axisPointer: {
                    type: 'shadow'
                }
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: '消息发布量',
                min: 0,
                max: {{ $messages }},
                interval: 10
            }
        ],
        series: [
            {
                name:'消息发布量',
                type:'bar',
                data:[@foreach($prev_day_message as $day){{ $day['count'] }},@endforeach]
            }
        ]
    };
    var optionCommentDay = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                crossStyle: {
                    color: '#999'
                }
            }
        },
        toolbox: {
            feature: {
                dataView: {show: true, readOnly: false},
                magicType: {show: true, type: ['line', 'bar']},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        legend: {
            data:['评论发布量']
        },
        xAxis: [
            {
                type: 'category',
                data: [@foreach($prev_day_comment as $day)'{{ $day['index'] }}',@endforeach],
                axisPointer: {
                    type: 'shadow'
                }
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: '评论发布量',
                min: 0,
                max: {{ $comments }},
                interval: 10
            }
        ],
        series: [
            {
                name:'评论发布量',
                type:'bar',
                data:[@foreach($prev_day_comment as $day){{ $day['count'] }},@endforeach]
            }
        ]
    };
    var optionAnnouncementDay = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                crossStyle: {
                    color: '#999'
                }
            }
        },
        toolbox: {
            feature: {
                dataView: {show: true, readOnly: false},
                magicType: {show: true, type: ['line', 'bar']},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        legend: {
            data:['公告发布量']
        },
        xAxis: [
            {
                type: 'category',
                data: [@foreach($prev_day_announcement as $day)'{{ $day['index'] }}',@endforeach],
                axisPointer: {
                    type: 'shadow'
                }
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: '公告发布量',
                min: 0,
                max: {{ $announcements }},
                interval: 10
            }
        ],
        series: [
            {
                name:'公告发布量',
                type:'bar',
                data:[@foreach($prev_day_announcement as $day){{ $day['count'] }},@endforeach]
            }
        ]
    };


    $('a[href="#course"]').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
        var myChartCourseMonth = echarts.init(document.getElementById('course-month'));
        var myChartCourseDay = echarts.init(document.getElementById('course-day'));
        myChartCourseDay.setOption(optionCourseDay);
        myChartCourseMonth.setOption(optionCourseMonth);
    });

    $('a[href="#active"]').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
        var myChartActiveMonth = echarts.init(document.getElementById('active-month'));
        var myChartActiveDay = echarts.init(document.getElementById('active-day'));
        myChartActiveMonth.setOption(optionActiveMonth);
        myChartActiveDay.setOption(optionActiveDay);
    });

    $('a[href="#league"]').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
        var myChartLeagueMonth = echarts.init(document.getElementById('league-month'));
        var myChartLeagueDay = echarts.init(document.getElementById('league-day'));
        myChartLeagueMonth.setOption(optionLeagueMonth);
        myChartLeagueDay.setOption(optionLeagueDay);
    });

    $('a[href="#announcement"]').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
        var myChartAnnouncementMonth = echarts.init(document.getElementById('announcement-month'));
        var myChartAnnouncementDay = echarts.init(document.getElementById('announcement-day'));
        myChartAnnouncementMonth.setOption(optionAnnouncementMonth);
        myChartAnnouncementDay.setOption(optionAnnouncementDay);
    });

    $('a[href="#good"]').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
        var myChartGoodMonth = echarts.init(document.getElementById('good-month'));
        var myChartGoodDay = echarts.init(document.getElementById('good-day'));
        myChartGoodMonth.setOption(optionGoodMonth);
        myChartGoodDay.setOption(optionGoodDay);
    });

    $('a[href="#message"]').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
        var myChartMessageMonth = echarts.init(document.getElementById('message-month'));
        var myChartMessageDay = echarts.init(document.getElementById('message-day'));
        myChartMessageMonth.setOption(optionMessageMonth);
        myChartMessageDay.setOption(optionMessageDay);
    });

    $('a[href="#comment"]').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
        var myChartCommentMonth = echarts.init(document.getElementById('comment-month'));
        var myChartCommentDay = echarts.init(document.getElementById('comment-day'));
        myChartCommentMonth.setOption(optionCommentMonth);
        myChartCommentDay.setOption(optionCommentDay);
    });
</script>
@endpush