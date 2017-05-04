@extends('layouts.admin')

@section('admin.title', '公告管理')

@section('breadcrumb')
    <li class="active">公告管理</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <blockquote>
                <b>公告总数：{{ $count }}</b>
                <a href="{{ url('admin/announcement/store') }}" class="btn btn-info pull-right"><i class="fa fa-plus"></i>添加系统公告</a>
            </blockquote>
            <table class="table table-hover Table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>标题</th>
                        <th>公告类型</th>
                        <th>评论数</th>
                        <th>浏览量</th>
                        <th>创建时间</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($announcements as $announcement)
                    <tr>
                        <td>{{ $announcement->id }}</td>
                        <td><a href="{{ $announcement->detailUrl() }}">{{ $announcement->title }}</a></td>
                        <td>{{ $announcement->typeToString() }}</td>
                        <td>{{ $announcement->comments()->count() }}</td>
                        <td>{{ $announcement->view->count or 0 }}</td>
                        <td>{{ $announcement->created_at->toDateString() }}</td>
                        <td>
                            <a href="{{ $announcement->editUrl() }}" operation="edit"><i class="fa fa-pencil fa-2x"></i></a>
                            <a href="{{ $announcement->deleteUrl() }}" operation="delete"><i class="fa fa-close fa-2x"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination-home">
                {!! $announcements->links() !!}
            </div>
        </div>
    </div>
@endsection