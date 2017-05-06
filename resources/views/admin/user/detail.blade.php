@extends('layouts.admin')

@section('admin.title', '用户详情')

@section('breadcrumb')
    <li><a href="{{ $user->homeUrl() }}">用户管理</a></li>
    <li class="active">用户详情</li>
@endsection

@section('admin.content')
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