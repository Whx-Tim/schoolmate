@extends('layouts.admin')

@section('admin.title', '首页')

@section('admin.content')
    <div class="row">
        <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter" id="day_users">{{ $day_users }}</p><span>今日新用户</span></div><div class="overview-icon"><i class="fa fa-user"></i></div></div></div></div>
        <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter" id="month_users">{{ $month_users }}</p><span>本月新用户</span></div><div class="overview-icon"><i class="fa fa-user"></i></div></div></div></div>
        <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter" id="users">{{ $users }}</p><span>总用户量</span></div><div class="overview-icon"><i class="fa fa-user"></i></div></div></div></div>
        <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter" id="view_active">{{ $view_active }}</p><span>活动总访问量</span></div><div class="overview-icon"><i class="fa fa-eye"></i></div></div></div></div>
        <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter" id="view_course">{{ $view_course }}</p><span>课程总访问量</span></div><div class="overview-icon"><i class="fa fa-eye"></i></div></div></div></div>
        <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter" id="view_league">{{ $view_league }}</p><span>社团总访问量</span></div><div class="overview-icon"><i class="fa fa-eye"></i></div></div></div></div>
        <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter" id="view_announcement">{{ $view_announcement }}</p><span>公告总访问量</span></div><div class="overview-icon"><i class="fa fa-eye"></i></div></div></div></div>
        <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter" id="view_info">{{ $view_info }}</p><span>信息总访问量</span></div><div class="overview-icon"><i class="fa fa-eye"></i></div></div></div></div>
        <div class="col-md-4"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter" id="views">{{ $views }}</p><span>总访问量</span></div><div class="overview-icon"><i class="fa fa-eye"></i></div></div></div></div>
        <div class="col-md-12" >
            <div class="panel panel-primary">
                <div class="panel-title">
                    <h4 class="text-center">用户注册活跃图</h4>
                </div>
                <div class="panel-body">
                    <div style="width: 100%;height: 600px;" id="user-day-map"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-title">
                    <h4 class="text-center">用户注册月统计图</h4>
                </div>
                <div class="panel-body">
                    <div style="width: 100%;height: 600px;" id="user-month-map"></div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('admin.scripts')
<script src="https://cdn.bootcss.com/echarts/3.5.4/echarts.min.js"></script>
<script>
    var myChart1 = echarts.init(document.getElementById('user-day-map'));
    var myChart2 = echarts.init(document.getElementById('user-month-map'));
    option1 = {
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
            data:['用户量']
        },
        xAxis: [
            {
                type: 'category',
                data: ['{{ $prev_day[1]['index'] }}','{{ $prev_day[2]['index'] }}','{{ $prev_day[3]['index'] }}','{{ $prev_day[4]['index'] }}','{{ $prev_day[5]['index'] }}','{{ $prev_day[6]['index'] }}','{{ $prev_day[7]['index'] }}','{{ $prev_day[8]['index'] }}'],
                axisPointer: {
                    type: 'shadow'
                }
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: '用户量',
                min: 0,
                max: {{ last(array_sort($prev_day, function ($value) {return $value['count'];}))['count'] }},
                interval: 10
            }
        ],
        series: [
            {
                name:'用户注册量',
                type:'line',
                data:[{{ $prev_day[1]['count'] }},{{ $prev_day[2]['count'] }},{{ $prev_day[3]['count'] }},{{ $prev_day[4]['count'] }},{{ $prev_day[5]['count'] }},{{ $prev_day[6]['count'] }},{{ $prev_day[7]['count'] }},{{ $prev_day[8]['count'] }}]
            }
//            {
//                name:'降水量',
//                type:'bar',
//                data:[2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3]
//            },
//            {
//                name:'平均温度',
//                type:'line',
//                yAxisIndex: 1,
//                data:[2.0, 2.2, 3.3, 4.5, 6.3, 10.2, 20.3, 23.4, 23.0, 16.5, 12.0, 6.2]
//            }
        ]
    };
    option2 = {
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
            data:['用户量']
        },
        xAxis: [
            {
                type: 'category',
                data: [@foreach($prev_month as $month)'{{ $month['index'] }}',@endforeach],
                axisPointer: {
                    type: 'shadow'
                }
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: '用户量',
                min: 0,
                max: {{ last(array_sort($prev_month, function ($value) {return $value['count'];}))['count'] }},
                interval: 10
            }
        ],
        series: [
            {
                name:'用户注册量',
                type:'bar',
                data:[@foreach($prev_month as $month){{ $month['count'] }},@endforeach]
            },
            {
                name:'用户注册量',
                type:'line',
                data:[@foreach($prev_month as $month){{ $month['count'] }},@endforeach]
            }
        ]
    };

    myChart1.setOption(option1);
    myChart2.setOption(option2);
</script>
@endpush

