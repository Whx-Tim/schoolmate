@extends('layouts.admin')

@section('admin.title', '系统设置')

@section('breadcrumb')
    <li class="active">系统设置</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">修改密码</h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="password" class="col-md-2 control-label">新密码</label>
                            <div class="col-md-10">
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="col-md-2 control-label">确认新的密码</label>
                            <div class="col-md-10">
                                <input type="password" name="password_confirmation" id="password_confirmation"  class="form-control">
                            </div>
                        </div>
                        <a href="{{ url('admin/setting/reset') }}" class="btn btn-block btn-primary" id="update-btn">更新</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection