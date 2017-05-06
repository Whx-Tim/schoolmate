@extends('layouts.admin')

@section('admin.title', '用户管理')

@section('breadcrumb')
    <li class="active">用户管理</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <blockquote>
                <b>用户总数：{{ $count }}</b>
            </blockquote>
            <table class="table table-hover Table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>用户名</th>
                        <th>邮箱</th>
                        <th>激活状态</th>
                        <th>昵称</th>
                        <th>入学年份</th>
                        <th>性别</th>
                        <th>创建时间</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->activeToString() }}</td>
                        <td>{{ $user->info->name }}</td>
                        <td>{{ $user->info->grade }}</td>
                        <td>{{ $user->info->gender }}</td>
                        <td>{{ $user->created_at->toDateString() }}</td>
                        <td>
                            <a href="{{ $user->editUrl() }}" operation="edit"><i class="fa fa-pencil fa-2x"></i></a>
                            <a href="{{ $user->deleteUrl() }}" operation="delete"><i class="fa fa-close fa-2x"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination-home">
                {!! $users->links() !!}
            </div>
        </div>
    </div>
@endsection