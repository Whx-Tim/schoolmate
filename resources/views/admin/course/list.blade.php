@extends('layouts.admin')

@section('admin.title', '课程管理')

@section('breadcrumb')
    <li class="active">课程管理</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <blockquote>
                <b>课程总数：{{ $count }}</b>
                <a href="{{ url('admin/course/store') }}" class="btn btn-info pull-right"><i class="fa fa-plus"></i>添加课程</a>
            </blockquote>
            <table class="table table-hover Table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>课程号</th>
                        <th>课程名称</th>
                        <th>主讲教师</th>
                        <th>课程状态</th>
                        <th>创建时间</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td>{{ $course->number }}</td>
                        <td><a href="{{ $course->detailUrl() }}">{{ $course->name }}</a></td>
                        <td>{{ $course->teacher }}</td>
                        <td>{{ $course->statusToString() }}</td>
                        <td>{{ $course->created_at->toDateString() }}</td>
                        <td>
                            <a href="{{ $course->editUrl() }}" operation="edit"><i class="fa fa-pencil fa-2x"></i></a>
                            <a href="{{ $course->deleteUrl() }}" operation="delete"><i class="fa fa-close fa-2x"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination-home">
                {!! $courses->links() !!}
            </div>
        </div>
    </div>
@endsection