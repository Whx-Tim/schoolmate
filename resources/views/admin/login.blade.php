@extends('layouts.admin')

@section('admin.title', '后台管理系统登录')

@push('head')
<link rel="stylesheet" href="{{ url('css/auth.css') }}">
@endpush

@section('admin.content')
    {{--<div class="row">--}}
        {{--<div class="col-md-6 col-md-offset-3">--}}
            {{--<div class="panel panel-primary">--}}
                {{--<div class="panel-title">--}}
                    {{--<h4>后台系统登录</h4>--}}
                {{--</div>--}}
                {{--<div class="panel-body">--}}
                    {{--<form class="form-horizontal" role="form">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="email" class="col-md-4 control-label">用户名</label>--}}
                            {{--<div class="col-md-6">--}}
                                {{--<input id="username" type="text" class="form-control" name="username" value="">--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="password" class="col-md-4 control-label">密码</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control" name="password">--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-8 col-md-offset-4">--}}
                                {{--<button type="button" class="btn btn-primary" id="login-btn">--}}
                                    {{--登录--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="Auth Auth--sign-in">
        <div class="Auth__wrapper">
            <div class="Auth__box">
                <div class="Auth__logo">
                    <a href="/">
                        <img src="/logo.png" alt="logo">
                    </a>
                </div>
                <div class="Auth__title">
                    <h4>校园资源互助平台后台管理系统</h4>
                </div>
                <form class="Auth__form" method="POST">
                    {{--{!! csrf_field() !!}--}}
                    <input type="hidden" name="remember" value="on">
                    <div class="Input Input--createdu">
                        <input class="Input__field Input__field--createdu" type="text" id="credential" name="username" required>
                        <label class="Input__label Input__label--createdu" for="credential">
                            <span class="Input__label-content Input__label-content--createdu">用户名</span>
                        </label>
                    </div>
                    <div class="Input Input--createdu">
                        <input class="Input__field Input__field--createdu" type="password" id="password" name="password" required>
                        <label class="Input__label Input__label--createdu" for="password">
                            <span class="Input__label-content Input__label-content--createdu">密码</span>
                        </label>
                        <span class="Input__eye"></span>
                    </div>
                    <div class="Input text-center">
                        <button class="Auth__submit" type="submit" id="login-btn"></button>
                    </div>
                </form>
                {{--@if(site('registrationOn'))--}}
                    {{--<div class="Auth__oauth">--}}
                        {{--@foreach(explode(",", Site::supportedOAuths()) as $service)--}}
                            {{--<a class="Auth__oauth__service {{ $service }}" href="@route('social', compact('service'))"></a>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                {{--@endif--}}
                <div class="Auth__separator"></div>
                <div class="Auth__extra">
                    {{--@lang('views.auth.login.no_account')&nbsp;<a href="@route('sign-up')">@lang('views.auth.login.register')</a>--}}
                    {{--@if(site('registrationOn'))--}}
                        {{--<div class="pull-right">--}}
                            {{--<a href="@route('reset')">@lang('views.auth.login.forgot_password')</a>--}}
                        {{--</div>--}}
                    {{--@endif--}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin.scripts')
<script src="{{ url('js/auth.js') }}"></script>
<script>
    $('#login-btn').click(function (e) {
        e.preventDefault();
        var formData = $('form').serialize();
        $.ajax({
            url: '{{ url('admin/login') }}',
            type: 'post',
            data: formData,
            dataType: 'json',
            success: function (data) {
                if (data.errcode) {
                    toastr.error('登录失败', data.errmsg);
                } else {
                    swal(data.errmsg, '' , 'success');
                    window.location.href = '/admin';
                }
            },
            error: function (error) {
                if (error.status == 422) {
                    var data = JSON.parse(error.responseText);
                    var message;
                    for (var x in data) {
                        message = data[x][0];
                    }
                    toastr.error('添加失败', message);
                } else {
                    toastr.error('操作异常','');
                }

            }
        })
    })
</script>
@endpush