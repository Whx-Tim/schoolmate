@extends('layouts.admin')

@section('admin.title', '商品管理')

@section('breadcrumb')
    <li class="active">商品管理</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <blockquote>
                <b>商品总数：{{ $count }}</b>
                <a href="{{ url('admin/good/store') }}" class="btn btn-info pull-right"><i class="fa fa-plus"></i>添加商品</a>
            </blockquote>
            <table class="table table-hover Table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>商品图片</th>
                        <th>商品名称</th>
                        <th>商品类型</th>
                        <th>商品价格</th>
                        <th>商品数量</th>
                        <th>状态</th>
                        <th>创建时间</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($goods as $good)
                    <tr>
                        <td>{{ $good->id }}</td>
                        <td><img src="{{ $good->shopPicture }}" style="width: 80px;height: 80px"></td>
                        <td><a href="{{ $good->detailUrl() }}">{{ $good->shopName }}</a></td>
                        <td>{{ $good->typeToString() }}</td>
                        <td>{{ $good->shopPrice }}</td>
                        <td>{{ $good->shopNumber }}</td>
                        <td>{{ $good->statusToString() }}</td>
                        <td>{{ $good->created_at->toDateString() }}</td>
                        <td>
                            <a href="{{ $good->editUrl() }}" operation="edit"><i class="fa fa-pencil fa-2x"></i></a>
                            <a href="{{ $good->deleteUrl() }}" operation="delete"><i class="fa fa-close fa-2x"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination-home">
                {!! $goods->links() !!}
            </div>
        </div>
    </div>
@endsection