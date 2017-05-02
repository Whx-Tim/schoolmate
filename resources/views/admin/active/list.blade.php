@extends('layouts.admin')

@section('admin.title', '活动管理')

@section('breadcrumb')
    <li class="active"><span>活动管理</span></li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <blockquote>
                <b>活动总数：{{ $count }}</b>
                <a href="{{ url('admin/active/store') }}" class="btn btn-info pull-right"><i class="fa fa-plus"></i>&nbsp;创建活动</a>
            </blockquote>
        </div>
        <div class="col-md-12">
            <table class="table table-hover Table">
                <thead>
                    <tr>
                        <th></th>
                        <th>活动名称</th>
                        <th>活动时间</th>
                        <th>联系人电话</th>
                        <th>活动状态</th>
                        <th>人数限制</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($actives as $active)
                    <tr>
                        <td>{{ $active->id }}</td>
                        <td>{{ $active->name }}</td>
                        <td>{{ $active->time }}</td>
                        <td>{{ $active->phone }}</td>
                        <td>{{ $active->status }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination-home">
                {!! $actives->links() !!}
            </div>
        </div>
    </div>
@endsection