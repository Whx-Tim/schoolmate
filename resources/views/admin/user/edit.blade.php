@extends('layouts.admin')

@section('admin.title', '编辑用户')

@section('breadcrumb')
    <li><a href="{{ $user->homeUrl() }}"></a>用户管理</li>
    <li class="active">编辑用户</li>
@endsection

@section('admin.content')
<div class="row">
    <div class="col-md-12">

    </div>
</div>
@endsection