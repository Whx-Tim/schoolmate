@extends('layouts.admin')

@section('admin.title', '编辑公告')

@section('breadcrumb')
    <li><a href="{{ $announcement->homeUrl() }}">公告管理</a></li>
    <li class="active">编辑公告</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <form>
                <div class="form-group">
                    <label>标题</label>
                    <input type="text" name="title" class="form-control" value="{{ $announcement->title }}">
                </div>
                <div class="form-group">
                    <label>内容</label>
                    <textarea name="content" class="summernote" rows="5">{{ $announcement->content }}</textarea>
                </div>
                <a href="{{ $announcement->editUrl() }}" class="btn btn-block btn-primary" id="update-btn">更新</a>
            </form>
        </div>
    </div>
@endsection