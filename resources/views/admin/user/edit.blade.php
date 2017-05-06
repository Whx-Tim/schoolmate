@extends('layouts.admin')

@section('admin.title', '编辑用户')

@section('breadcrumb')
    <li><a href="{{ $user->homeUrl() }}"></a>用户管理</li>
    <li class="active">编辑用户</li>
@endsection

@section('admin.content')
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>活动封面图片</label>
            <img src="{{ $user->info->wx_head_img }}" alt="" style="width: 100%;">
            <div id="dropzone" class="dropzone"></div>
        </div>
        <form>
            <div class="form-group">
                <label>用户名</label><input type="text" name="username" class="form-control" value="{{ $user->username }}" readonly>
            </div>
            <div class="form-group">
                <label>真实姓名</label><input type="text" name="username" class="form-control" value="{{ $user->info->realname }}">
            </div>
            <div class="form-group">
                <label>邮箱</label><input type="text" name="username" class="form-control" value="{{ $user->email }}">
            </div>
            <div class="form-group">
                <label>学号</label><input type="text" name="username" class="form-control" value="{{ $user->info->student_id }}">
            </div>
            <div class="form-group">
                <label>学院</label><input type="text" name="username" class="form-control" value="{{ $user->info->college }}">
            </div>
            <div class="form-group">
                <label>入学年份</label><input type="text" name="username" class="form-control" value="{{ $user->info->grade }}">
            </div>
            <div class="form-group">
                <label>性别</label>
                <select name="gender" class="form-control">
                    <option value="1" {{ $user->info->gender==1 ? 'selected': '' }}>男</option>
                    <option value="2" {{ $user->info->gender==2 ? 'selected': '' }}>女</option>
                </select>
            </div>
            <div class="form-group">
                <label>联系电话</label><input type="text" name="username" class="form-control" value="{{ $user->info->phone }}">
            </div>
            <div class="form-group">
                <label>生日</label><input type="text" name="username" class="form-control" value="{{ $user->info->birthday }}">
            </div>
            <div class="form-group">
                <label>激活状态</label>
                <select name="is_active" class="form-control">
                    <option value="0" {{ $user->is_active==0 ? 'selected' : '' }}>未激活</option>
                    <option value="1" {{ $user->is_active==1 ? 'selected' : '' }}>已激活</option>
                </select>
            </div>
            <div class="form-group">
                <label>认证状态</label>
                <select name="is_certified" class="form-control">
                    <option value="0" {{ $user->info->is_certified==0 ? 'selected' : '' }}>未认证</option>
                    <option value="1" {{ $user->info->is_certified==1 ? 'selected' : '' }}>已认证</option>
                </select>
            </div>
            <input type="hidden" name="wx_head_img" value="">
            <a href="{{ $user->editUrl() }}" class="btn btn-block btn-primary" id="update-btn">更新</a>
        </form>
    </div>
</div>
@endsection