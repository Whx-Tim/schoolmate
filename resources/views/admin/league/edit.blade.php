@extends('layouts.admin')

@section('admin.title', '编辑社团')

@section('breadcrumb')
    <li><a href="{{ $league->homeUrl() }}">社团管理</a></li>
    <li class="active">编辑社团</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>社团封面图片</label>
                <img src="{{ url($league->poster) }}" alt="" style="width: 100%;">
                <div id="dropzone" class="dropzone"></div>
            </div>
            <form>
                <div class="form-group">
                    <label>社团名称</label>
                    <input type="text" name="name" class="form-control" value="{{ $league->name }}">
                </div>
                <div class="form-group">
                    <label>限制人数</label>
                    <input type="text" name="amount" class="form-control" value="{{ $league->amount }}">
                </div>
                <div class="form-group">
                    <label>社团类型</label>
                    <select name="type" class="form-control">
                        <option value="1" {{ $league->type==1 ? 'selected' : '' }}>1</option>
                        <option value="2" {{ $league->type==2 ? 'selected' : '' }}>2</option>
                        <option value="3" {{ $league->type==3 ? 'selected' : '' }}>3</option>
                        <option value="4" {{ $league->type==4 ? 'selected' : '' }}>4</option>
                        <option value="5" {{ $league->type==5 ? 'selected' : '' }}>5</option>
                        <option value="6" {{ $league->type==6 ? 'selected' : '' }}>6</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>社团状态</label>
                    <select name="status" class="form-control">
                        <option value="0" {{ $league->status==0 ? 'selected' : '' }}>未审核</option>
                        <option value="1" {{ $league->status==1 ? 'selected' : '' }}>已审核</option>
                        <option value="2" {{ $league->status==2 ? 'selected' : '' }}>已关闭</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>社团介绍</label>
                    <textarea name="introduction" class="summernote">{{ $league->introduction }}</textarea>
                </div>
                <input type="hidden" name="poster" value="{{ $league->poster }}">
                <a href="{{ $league->editUrl() }}" class="btn btn-primary btn-block" id="update-btn">更新</a>
            </form>
        </div>
    </div>
@endsection