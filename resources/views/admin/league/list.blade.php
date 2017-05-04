@extends('layouts.admin')

@section('admin.title', '社团管理')

@section('breadcrumb')
    <li class="active">社团管理</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <blockquote>
                <b>社团总数：{{ $count }}</b>
                <a href="{{ url('admin/league/store') }}" class="btn btn-info pull-right"><i class="fa fa-plus"></i>添加社团</a>
            </blockquote>
            <table class="table table-hover Table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>社团名称</th>
                        <th>社团限制人数</th>
                        <th>社团类型</th>
                        <th>社团状态</th>
                        <th>创建时间</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($leagues as $league)
                    <tr>
                        <td>{{ $league->id }}</td>
                        <td><a href="{{ $league->detailUrl() }}">{{ $league->name }}</a></td>
                        <td>{{ $league->amount }}</td>
                        <td>{{ $league->type }}</td>
                        <td>{{ $league->statusToString() }}</td>
                        <td>{{ $league->created_at->toDateString() }}</td>
                        <td>
                            <a href="{{ $league->editUrl() }}" operation="edit"><i class="fa fa-pencil fa-2x"></i></a>
                            <a href="{{ $league->deleteUrl() }}" operation="delete"><i class="fa fa-close fa-2x"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination-home">
                {!! $leagues->links() !!}
            </div>
        </div>
    </div>
@endsection