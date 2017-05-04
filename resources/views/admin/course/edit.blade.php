@extends('layouts.admin')

@section('admin.title', '编辑课程')

@section('breadcrumb')
    <li><a href="{{ $course->homeUrl() }}">课程管理</a></li>
    <li class="active">编辑课程</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <form>
                <div class="form-group">
                    <label>课程号</label>
                    <input type="text" class="form-control" name="number" value="{{ $course->number }}">
                </div>
                <div class="form-group">
                    <label>课程名称</label>
                    <input type="text" class="form-control" name="name" value="{{ $course->name }}">
                </div>
                <div class="form-group">
                    <label>主讲教师</label>
                    <input type="text" class="form-control" name="teacher" value="{{ $course->teacher }}">
                </div>
                <div class="form-group">
                    <label>课程状态</label>
                    <select name="status" class="form-control">
                        <option value="0" {{ $course->status==0 ? 'selected' : '' }}>未审核</option>
                        <option value="1" {{ $course->status==1 ? 'selected' : '' }}>已审核</option>
                        <option value="2" {{ $course->status==2 ? 'selected' : '' }}>已关闭</option>
                    </select>
                </div>
                <a href="{{ $course->editUrl() }}" class="btn btn-block btn-primary" id="update-btn">更新</a>
            </form>
        </div>
    </div>
@endsection
