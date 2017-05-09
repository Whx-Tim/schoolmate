@extends('layouts.admin')

@section('admin.title', '商品详情')

@section('breadcrumb')
    <li><a href="{{ $good->homeUrl() }}">商品管理</a></li>
    <li class="active">商品详情</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <ul class="list-group">
                <li class="list-group-item"><div class="row"><div class="col-md-2">商品图片</div><div class="col-md-10"><img src="{{ $good->shopPicture }}" alt=""></div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">商品名称</div><div class="col-md-10">{{ $good->shopName }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">商品类型</div><div class="col-md-10">{{ $good->typeToString() }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">商品价格</div><div class="col-md-10">{{ $good->shopPrice }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">商品数量</div><div class="col-md-10">{{ $good->shopNumber }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">浏览量</div><div class="col-md-10">{{ $good->view->count or 0 }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">状态</div><div class="col-md-10">{{ $good->statusToString() }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">创建者用户</div><div class="col-md-10">{{ $good->user->username }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">创建时间</div><div class="col-md-10">{{ $good->created_at }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">更新时间</div><div class="col-md-10">{{ $good->updated_at }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">删除时间</div><div class="col-md-10">{{ $good->deleted_at }}</div></div></li>
                <li class="list-group-item"><div class="row"><div class="col-md-2">商品描述</div><div class="col-md-12">{{ $good->shopDescription }}</div></div></li>
            </ul>
        </div>
    </div>
@endsection