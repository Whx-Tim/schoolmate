@extends('layouts.admin')

@section('admin.title', '后台管理系统登录')

@section('admin.content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-title">
                    <h4>后台系统登录</h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">用户名</label>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">密码</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="button" class="btn btn-primary" id="login-btn">
                                    登录
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin.scripts')
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