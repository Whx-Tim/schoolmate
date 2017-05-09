@extends('layouts.admin')

@section('admin.title', '用户详情')

@section('breadcrumb')
    <li><a href="{{ $user->homeUrl() }}">用户管理</a></li>
    <li class="active">用户详情</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-3"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter" id="active">{{ $actives }}</p><span>发布的活动数</span></div><div class="overview-icon"><i class="fa fa-envira"></i></div></div></div></div>
        <div class="col-md-3"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter" id="apply_active">{{ $apply_actives }}</p><span>参与的活动数</span></div><div class="overview-icon"><i class="fa fa-envira"></i></div></div></div></div>
        <div class="col-md-3"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter" id="league">{{ $leagues }}</p><span>发布的社团数</span></div><div class="overview-icon"><i class="fa fa-users"></i></div></div></div></div>
        <div class="col-md-3"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter" id="apply_league">{{ $apply_leagues }}</p><span>参加的社团数</span></div><div class="overview-icon"><i class="fa fa-users"></i></div></div></div></div>
        <div class="col-md-3"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter" id="course">{{ $courses }}</p><span>创建的课程数</span></div><div class="overview-icon"><i class="fa fa-book"></i></div></div></div></div>
        <div class="col-md-3"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter" id="apply_course">{{ $apply_courses }}</p><span>参与的课程数</span></div><div class="overview-icon"><i class="fa fa-book"></i></div></div></div></div>
        <div class="col-md-3"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter" id="comment">{{ $comments }}</p><span>发布的评论数</span></div><div class="overview-icon"><i class="fa fa-comments"></i></div></div></div></div>
        <div class="col-md-3"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter" id="message">{{ $messages }}</p><span>发布的消息数</span></div><div class="overview-icon"><i class="fa fa-send"></i></div></div></div></div>
        <div class="col-md-3"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter" id="good">{{ $goods }}</p><span>发布的商品数</span></div><div class="overview-icon"><i class="fa fa-shopping-basket"></i></div></div></div></div>
        <div class="col-md-3"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter" id="active_info">{{ $active_infos }}</p><span>发布的活动公告数</span></div><div class="overview-icon"><i class="fa fa-info-circle"></i></div></div></div></div>
        <div class="col-md-3"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter" id="course_info">{{ $course_infos }}</p><span>发布的课程公告数</span></div><div class="overview-icon"><i class="fa fa-info-circle"></i></div></div></div></div>
        <div class="col-md-3"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter" id="league_info">{{ $league_infos }}</p><span>发布的社团公告数</span></div><div class="overview-icon"><i class="fa fa-info-circle"></i></div></div></div></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="list-group">
                <li class="list-group-item"><div class="row"><div class="col-md-2">用户名</div><div class="col-md-10">{{ $user->username }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">邮箱</div><div class="col-md-10">{{ $user->email }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">激活状态</div><div class="col-md-10">{{ $user->activeToString() }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">认证状态</div><div class="col-md-10">{{ $user->is_certified() }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">真实姓名</div><div class="col-md-10">{{ $user->info->realname }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">微信昵称</div><div class="col-md-10">{{ $user->info->wx_nickname }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">微信头像</div><div class="col-md-10"><img src="{{ $user->info->wx_head_img }}" alt=""></div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">微信openid</div><div class="col-md-10">{{ $user->info->wx_openid }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">学号</div><div class="col-md-10">{{ $user->info->student_id }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">学院</div><div class="col-md-10">{{ $user->info->college }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">入学年份</div><div class="col-md-10">{{ $user->info->grade }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">性别</div><div class="col-md-10">{{ $user->genderToString() }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">联系电话</div><div class="col-md-10">{{ $user->info->phone }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">生日</div><div class="col-md-10">{{ $user->info->birthday }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">创建时间</div><div class="col-md-10">{{ $user->created_at }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">更新时间</div><div class="col-md-10">{{ $user->info->updated_at }}</div></div></li>
            </ul>
        </div>
    </div>
@endsection