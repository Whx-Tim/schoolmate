@extends('layouts.admin')

@section('admin.title', '编辑信息')

@section('breadcrumb')
    <li><a href="{{ $info->homeUrl() }}">信息管理</a></li>
    <li>编辑信息</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <form>
                <div class="form-group"><label>公司名称</label><input type="text" name="company_name" class="form-control" value="{{ $info->company_name or '' }}"></div>
                <div class="form-group"><label>公司地址</label><input type="text" name="address" class="form-control" value="{{ $info->address or '' }}"></div>
                <div class="form-group"><label>联系电话</label><input type="text" name="phone" class="form-control" value="{{ $info->phone or '' }}"></div>
                <div class="form-group"><label>联系邮箱</label><input type="text" name="email" class="form-control" value="{{ $info->email or '' }}"></div>
                <div class="form-group"><label>薪资</label><input type="text" name="salary" class="form-control" value="{{ $info->salary or '' }}"></div>
                <div class="form-group"><label>招聘职位</label><input type="text" name="position" class="form-control" value="{{ $info->position or '' }}"></div>
                <div class="form-group"><label>工作时间</label><input type="text" name="job_time" class="form-control" value="{{ $info->job_time or '' }}"></div>
                <div class="form-group"><label>公司类型</label><input type="text" name="company_type" class="form-control" value="{{ $info->company_type or '' }}"></div>
                <div class="form-group"><label>工作至少时长</label><input type="text" name="duration" class="form-control" value="{{ $info->duration or '' }}"></div>
                <div class="form-group"><label>学历要求</label><input type="text" name="education" class="form-control" value="{{ $info->education or '' }}"></div>
                <div class="form-group"><label>招聘人数</label><input type="text" name="amount" class="form-control" value="{{ $info->amount or '' }}"></div>
                <div class="form-group"><label>截止时间</label><input type="text" name="end_time" class="form-control" value="{{ $info->end_time or '' }}"></div>
                <div class="form-group"><label>招聘详情描述</label>
                    <textarea name="description" class="summernote">{{ $info->description or '' }}</textarea></div>
                <a href="{{ $info->editUrl() }}" class="btn btn-block btn-primary" id="update-btn">更新</a>
            </form>
        </div>
    </div>
@endsection