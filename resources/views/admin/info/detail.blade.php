@extends('layouts.admin')

@section('admin.title', '信息详情')

@section('breadcrumb')
    <li><a href="{{ $info->homeUrl() }}">信息管理</a></li>
    <li class="active">信息详情</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <ul class="list-group">
                <li class="list-group-item"><div class="row"><div class="col-md-2">公司名称</div><div class="col-md-10">{{ $info->company_name }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">公司地址</div><div class="col-md-10">{{ $info->address }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">联系电话</div><div class="col-md-10">{{ $info->phone }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">联系邮箱</div><div class="col-md-10">{{ $info->email }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">薪资</div><div class="col-md-10">{{ $info->salary }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">职位</div><div class="col-md-10">{{ $info->position }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">工作时间</div><div class="col-md-10">{{ $info->job_time }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">公司类型</div><div class="col-md-10">{{ $info->company_type }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">工作最少时长</div><div class="col-md-10">{{ $info->duration }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">学历要求</div><div class="col-md-10">{{ $info->education }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">招聘数量</div><div class="col-md-10">{{ $info->amount }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">截止时间</div><div class="col-md-10">{{ $info->end_time }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">访问量</div><div class="col-md-10">{{ $info->view->count }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">创建时间</div><div class="col-md-10">{{ $info->created_at }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">创建用户</div><div class="col-md-10">{{ $info->user->username }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">招聘描述</div><div class="col-md-12">{{ $info->description }}</div></div></li>
            </ul>
        </div>
    </div>
@endsection