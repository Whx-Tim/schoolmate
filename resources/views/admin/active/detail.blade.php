@extends('layouts.admin')

@section('admin.title', '活动详情')

@section('breadcrumb')
    <li><span>活动管理</span></li>
    <li class="active"><span>活动详情</span></li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2">活动名称</div><div class="col-md-10">{{ $active->name }}</div>
            <div class="col-md-2">活动时间</div><div class="col-md-10">{{ $active->time }}</div>
            <div class="col-md-2">活动地址</div><div class="col-md-10">{{ $active->address }}</div>
            <div class="col-md-2">经度</div><div class="col-md-10">{{ $active->lng }}</div>
            <div class="col-md-2">纬度</div><div class="col-md-10">{{ $active->lat }}</div>
            <div class="col-md-2">参与人数</div><div class="col-md-10">{{ $active->count }}</div>
            <div class="col-md-2">联系人电话</div><div class="col-md-10">{{ $active->phone }}</div>
            <div class="col-md-2">活动状态</div><div class="col-md-10">{{ $active->status }}</div>
            <div class="col-md-2">人数限制</div><div class="col-md-10">{{ $active->person }}</div>
            <div class="col-md-2">活动描述</div><div class="col-md-12">{{ $active->description }}</div>
        </div>
    </div>
@endsection