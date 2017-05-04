@extends('layouts.admin')

@section('admin.title', '添加社团')

@section('breadcrumb')
    <li><a href="{{ url('admin/league') }}">社团管理</a></li>
    <li class="active">添加社团</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>社团封面图片</label>
                <img src="" alt="" style="width: 100%;">
                <div id="dropzone" class="dropzone"></div>
            </div>
            <form>
                <div class="form-group">
                    <label class="required">社团名称</label>
                    <input type="text" name="name" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label class="required">限制人数</label>
                    <input type="text" name="amount" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label class="required">社团类型</label>
                    <select name="type" class="form-control">
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                        <option value="5" >5</option>
                        <option value="6" >6</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="required">社团状态</label>
                    <select name="status" class="form-control">
                        <option value="0" >未审核</option>
                        <option value="1" >已审核</option>
                        <option value="2" >已关闭</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>社团介绍</label>
                    <textarea name="introduction" class="summernote"></textarea>
                </div>
                <input type="hidden" name="poster" value="">
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <a href="{{ url('admin/league/store') }}" class="btn btn-primary btn-block" id="add-btn">添加</a>
            </form>
        </div>
    </div>
@endsection