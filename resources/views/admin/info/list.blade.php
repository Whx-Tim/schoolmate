@extends('layouts.admin')

@section('admin.title', '信息管理')

@section('braedcrumb')
    <li class="active">信息管理</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <blockquote>
                <b>信息总数：{{ $count }}</b>
                <a href="{{ url('admin/info/store') }}" class="btn btn-info pull-right"><i class="fa fa-plus"></i>添加信息</a>
            </blockquote>
            <table class="table table-hover Table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>公司名称</th>
                        <th>联系电话</th>
                        <th>联系邮箱</th>
                        <th>截止时间</th>
                        <th>创建时间</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($infos as $info)
                    <tr>
                        <td>{{ $info->id }}</td>
                        <td><a href="{{ $info->detailUrl() }}">{{ $info->company_name }}</a></td>
                        <td>{{ $info->phone }}</td>
                        <td>{{ $info->email }}</td>
                        <td>{{ $info->end_time->toDateString() }}</td>
                        <td>{{ $info->created_at->toDateString() }}</td>
                        <td>
                            <a href="{{ $info->editUrl() }}" operation="edit"><i class="fa fa-pencil fa-2x"></i></a>
                            <a href="{{ $info->deleteUrl() }}" operation="delete"><i class="fa fa-close fa-2x"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection