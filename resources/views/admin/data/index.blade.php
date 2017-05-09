@extends('layouts.admin')

@section('admin.title', '数据工厂')

@section('breadcrumb')
    <li class="active">数据工厂</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 class="panel-title">用户数据工厂</h4>
                </div>
                <div class="panel-body">
                    <form>
                        <div class="form-group">
                            <label>用户数</label>
                            <input type="number" class="form-control" name="amount">
                        </div>
                        <div class="col-md-8 col-md-offset-2">
                            <a href="{{ url('admin/data/user') }}" class="btn btn-primary btn-block generate-btn">生成</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 class="panel-title">活动数据工厂</h4>
                </div>
                <div class="panel-body">
                    <form>
                        <div class="form-group">
                            <label>活动数</label>
                            <input type="number" class="form-control" name="amount">
                        </div>
                        <div class="col-md-8 col-md-offset-2">
                            <a href="{{ url('admin/data/active') }}" class="btn btn-primary btn-block generate-btn">生成</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 class="panel-title">课程数据工厂</h4>
                </div>
                <div class="panel-body">
                    <form>
                        <div class="form-group">
                            <label>课程数</label>
                            <input type="number" class="form-control" name="amount">
                        </div>
                        <div class="col-md-8 col-md-offset-2">
                            <a href="{{ url('admin/data/course') }}" class="btn btn-primary btn-block generate-btn">生成</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 class="panel-title">社团数据工厂</h4>
                </div>
                <div class="panel-body">
                    <form>
                        <div class="form-group">
                            <label>社团数</label>
                            <input type="number" class="form-control" name="amount">
                        </div>
                        <div class="col-md-8 col-md-offset-2">
                            <a href="{{ url('admin/data/league') }}" class="btn btn-primary btn-block generate-btn">生成</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 class="panel-title">商品数据工厂</h4>
                </div>
                <div class="panel-body">
                    <form>
                        <div class="form-group">
                            <label>商品数</label>
                            <input type="number" class="form-control" name="amount">
                        </div>
                        <div class="col-md-8 col-md-offset-2">
                            <a href="{{ url('admin/data/good') }}" class="btn btn-primary btn-block generate-btn">生成</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 class="panel-title">公告数据工厂</h4>
                </div>
                <div class="panel-body">
                    <form>
                        <div class="form-group">
                            <label>公告数</label>
                            <input type="number" class="form-control" name="amount">
                        </div>
                        <div class="col-md-8 col-md-offset-2">
                            <a href="{{ url('admin/data/announcement') }}" class="btn btn-primary btn-block generate-btn">生成</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin.scripts')
<script>
    $('.generate-btn').each(function () {
        $(this).click(function (e) {
            e.preventDefault();
            var formData = $(this).parents('form').serialize();
            var url = $(this).attr('href');
//            console.log(url);
//            console.log(formData);
            $.ajax({
                url: url,
                data: formData,
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    if (data.errcode) {
                        toastr.error(data.errmsg);
                    } else {
                        toastr.success(data.errmsg);
                    }
                },
                error: function (error){
                    toastr.error('系统错误');
                    console.log(error.responseText);
                }
            })
        })
    })
</script>
@endpush