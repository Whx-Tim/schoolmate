@extends('layouts.admin')

@section('admin.title', '添加课程')

@section('breadcrumb')
    <li><a href="{{ url('admin/course') }}">课程管理</a></li>
    <li class="active">添加课程</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <form>
                <div class="form-group">
                    <label class="required">课程号</label>
                    <input type="text" class="form-control" name="number" value="">
                </div>
                <div class="form-group">
                    <label class="required">课程名称</label>
                    <input type="text" class="form-control" name="name" value="">
                </div>
                <div class="form-group">
                    <label class="required">主讲教师</label>
                    <input type="text" class="form-control" name="teacher" value="">
                </div>
                <div class="form-group">
                    <label>课程状态</label>
                    <select name="status" class="form-control">
                        <option value="0" >未审核</option>
                        <option value="1" >已审核</option>
                        <option value="2" >已关闭</option>
                    </select>
                </div>
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <a href="{{ url('admin/course/store') }}" class="btn btn-block btn-primary" id="add-btn">添加</a>
            </form>
        </div>
    </div>
@endsection