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
                <div class="form-group"><label>公司名称</label><input type="text" name="company_name" class="form-control" value="{{ $info->company_name }}"></div>
                <div class="form-group"><label>公司地址</label><input type="text" name="company_name" class="form-control" value="{{ $info->company_name }}"></div>
                <div class="form-group"><label>联系电话</label><input type="text" name="company_name" class="form-control" value="{{ $info->company_name }}"></div>
                <div class="form-group"><label>联系邮箱</label><input type="text" name="company_name" class="form-control" value="{{ $info->company_name }}"></div>
                <div class="form-group"><label>薪资</label><input type="text" name="company_name" class="form-control" value="{{ $info->company_name }}"></div>
                <div class="form-group"><label>招聘职位</label><input type="text" name="company_name" class="form-control" value="{{ $info->company_name }}"></div>
                <div class="form-group"><label>工作时间</label><input type="text" name="company_name" class="form-control" value="{{ $info->company_name }}"></div>
                <div class="form-group"><label>公司类型</label><input type="text" name="company_name" class="form-control" value="{{ $info->company_name }}"></div>
                <div class="form-group"><label>工作至少时长</label><input type="text" name="company_name" class="form-control" value="{{ $info->company_name }}"></div>
                <div class="form-group"><label>学历要求</label><input type="text" name="company_name" class="form-control" value="{{ $info->company_name }}"></div>
                <div class="form-group"><label>招聘人数</label><input type="text" name="company_name" class="form-control" value="{{ $info->company_name }}"></div>
                <div class="form-group"><label>截止时间</label><input type="text" name="company_name" class="form-control" value="{{ $info->company_name }}"></div>
                <div class="form-group"><label></label><input type="text" name="company_name" class="form-control" value="{{ $info->company_name }}"></div>
            </form>
        </div>
    </div>
@endsection