@extends('layouts.admin')

@section('admin.title', '社团详情')

@section('breadcrumb')
    <li><a href="{{ $league->homeUrl() }}">社团管理</a></li>
    <li class="active">社团详情</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <ul class="list-group">
                <li class="list-group-item"><div class="row"><div class="col-md-2">社团海报</div><div class="col-md-10"><img src="{{ url($league->poster) }}"></div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">社团名称</div><div class="col-md-10">{{ $league->name }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">限制人数</div><div class="col-md-10">{{ $league->amount }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">社团类型</div><div class="col-md-10">{{ $league->type }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">社团状态</div><div class="col-md-10">{{ $league->statusToString() }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">创建用户</div><div class="col-md-10">{{ $league->userName() }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">创建时间</div><div class="col-md-10">{{ $league->created_at }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">更新时间</div><div class="col-md-10">{{ $league->updated_at }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">删除时间</div><div class="col-md-10">{{ $league->deleted_at }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">社团介绍</div><div class="col-md-12">{!! $league->introduction !!}</div></div></li>
            </ul>
        </div>
    </div>
@endsection

