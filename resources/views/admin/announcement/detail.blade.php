@extends('layouts.admin')

@section('admin.title', '公告详情')

@section('breadcrumb')
    <li><a href="{{ $announcement->homeUrl() }}">公告管理</a></li>
    <li class="active">公告详情</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <ul class="list-group">
                <li class="list-group-item"><div class="row"><div class="col-md-2">标题</div><div class="col-md-10">{{ $announcement->title }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">类型</div><div class="col-md-10">{{ $announcement->typeToString() }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">访问量</div><div class="col-md-10">{{ $announcement->view->count or 0}}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">评论量</div><div class="col-md-10">{{ $announcement->comments()->count() }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">创建时间</div><div class="col-md-10">{{ $announcement->created_at }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">更新时间</div><div class="col-md-10">{{ $announcement->updated_at }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">内容</div><div class="col-md-12">{!! $announcement->content !!}</div></div></li>
            </ul>
        </div>
    </div>
@endsection