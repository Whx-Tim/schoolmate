@extends('layouts.admin')

@section('admin.title', '课程详情')

@section('breadcrumb')
    <li><a href="{{ $course->homeUrl() }}">课程管理</a></li>
    <li class="active">课程详情</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-6"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $course->view->count or 0 }}</p><span>浏览量</span></div><div class="overview-icon"><i class="fa fa-eye"></i></div></div></div></div>
        <div class="col-md-6"><div class="Overview Panel"><div class="Content overview-content"><div class="overview-title"><p class="counter">{{ $applyCount }}</p><span>参与人数</span></div><div class="overview-icon"><i class="fa fa-user"></i></div></div></div></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="list-group">
                <li class="list-group-item"><div class="row"><div class="col-md-2">课程号</div><div class="col-md-10">{{ $course->number }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">课程名称</div><div class="col-md-10">{{ $course->name }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">主讲教师</div><div class="col-md-10">{{ $course->teacher }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">课程状态</div><div class="col-md-10">{{ $course->statusToString() }}</div></div></li>
{{--                <li class="list-group-item"><div class="row"><div class="col-md-2">浏览量</div><div class="col-md-10">{{ $course->view->count or 0 }}</div></div></li>--}}
                <li class="list-group-item"><div class="row"><div class="col-md-2">创建时间</div><div class="col-md-10">{{ $course->created_at }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">更新时间</div><div class="col-md-10">{{ $course->updated_at }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">删除时间</div><div class="col-md-10">{{ $course->deleted_at }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">创建用户id</div><div class="col-md-10">{{ $course->user_id }}</div></div></li>
            </ul>
        </div>
    </div>
@endsection