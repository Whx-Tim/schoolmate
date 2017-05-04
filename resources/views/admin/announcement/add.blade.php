@extends('layouts.admin')

@section('admin.title', '添加公告')

@section('breadcrumb')
    <li><a href="{{ url('admin/announcement') }}">公告管理</a></li>
    <li class="active">编辑公告</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <form>
                <div class="form-group">
                    <label>标题</label>
                    <input type="text" name="title" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label>内容</label>
                    <textarea name="content" class="summernote" rows="5"></textarea>
                </div>
                <a href="{{ url('admin/announcement/store') }}" class="btn btn-block btn-primary" id="add-btn">发布</a>
            </form>
        </div>
    </div>
@endsection