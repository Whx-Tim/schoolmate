@extends('layouts.base')

@section('title')@yield('admin.title') - 后台管理@stop

@section('base.content')
    <div class="Admin">
        @if(Auth::check())
            @include('layouts.partials.admin-sidebar')
        @endif
        <main class="Container">
            @if(Auth::check())
                @include('layouts.partials.admin-breadcrumb')
            @endif
            @yield('admin.content')

        </main>

    </div>
@stop

@push('head')
<meta name="_token" content="{{ csrf_token() }}">
@endpush

@push('scripts.footer')
<script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ url('js/plugins/dropzone.min.js') }}"></script>
<script src="{{ url('js/plugins/summernote.min.js') }}"></script>
<script src="{{ url('js/plugins/toastr.min.js') }}"></script>
<script src="{{ url('js/plugins.js') }}"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=2aLkRxKYccsqt8NlvVsgURX99OIUbabz"></script>
<script src="https://js.pusher.com/4.0/pusher.min.js"></script>
<script type="text/javascript">

    Pusher.logToConsole = true;

    var pusher = new Pusher('5a573c7b51d3fbfc6713', {
        cluster: 'ap1',
        encrypted: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('message-event-1-2', function(data) {
        alert(data.message);
    });
    channel.bind('message-event-1', function(data) {
        alert(data.message);
    });

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-full-width",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "slideDown",
            "hideMethod": "slideUp"
        };

        $('[operation=edit]').tooltip({
            placement: 'top',
            title: '编辑'
        });
        var $delete = $('[operation=delete]');
        $delete.tooltip({
            placement: 'top',
            title: '删除'
        });

        $delete.click(function (e) {
            e.preventDefault();
            var href = $(this).attr('href');
            var $this = $(this);
            console.log($this.parents('tr'));


            swal({
                title: '确定删除吗?',
                text: '',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: '确认删除',
                cancelButtonText: '点错了',
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {
                $.ajax({
                    url: href,
                    type: 'get',
                    dataType: 'json',
                    success: function (data) {
                        if (data.errcode) {
                            swal('删除失败',data.errmsg, 'error');
                        } else {
                            swal('删除成功',data.errmsg, 'success');
                            $this.parents('tr').hide(600);
                        }
                    },
                    error: function (error) {
                        swal('操作异常','','error');
                    }
                })
            })

        });

        $('#update-btn').click(function (e) {
            e.preventDefault();
            var formData = $(this).parent().serialize();
            var url = $(this).attr('href');
            swal({
                title: '确定更新吗?',
                text: '',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: '确认更新',
                cancelButtonText: '点错了',
                closeOnConfirm: false
//                showLoaderOnConfirm: true
            }, function () {
                $.ajax({
                    url: url,
                    type: 'post',
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        if (data.errcode) {
//                            toastr.error('保存失败', data.errmsg);
                            swal(data.errmsg,'','error');
                        } else {
//                            toastr.success('保存成功');
                            swal(data.errmsg, '' , 'success');
                        }
                    },
                    error: function (error) {
                        if (error.status == 422) {
                            var data = JSON.parse(error.responseText);
                            var message;
                            for (var x in data) {
                                message = data[x][0];
                            }
                            swal('添加失败', message, 'error');
                        } else {
                            swal('操作异常','','error');
                        }
                    }
                })
            })
        });

        $('#add-btn').click(function (e) {
            e.preventDefault();
            var formData = $(this).parent().serialize();
            var url = $(this).attr('href');
            swal({
                title: '确定添加吗?',
                text: '',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: '确认添加',
                cancelButtonText: '点错了',
                closeOnConfirm: false
//                showLoaderOnConfirm: true
            }, function () {
                $.ajax({
                    url: url,
                    type: 'post',
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        if (data.errcode) {
//                            toastr.error('保存失败', data.errmsg);
                            swal(data.errmsg,'','error');
                        } else {
//                            toastr.success('保存成功');
                            swal(data.errmsg, '' , 'success');
                        }
                    },
                    error: function (error) {
                        if (error.status == 422) {
                            var data = JSON.parse(error.responseText);
                            var message;
                            for (var x in data) {
                                message = data[x][0];
                            }
                            swal('添加失败', message, 'error');
                        } else {
                            swal('操作异常','','error');
                        }

                    }
                })
            })
        });

        $('.summernote').summernote();

        $('.dropzone').dropzone({
            url: '{{ url('admin/upload') }}',
            method: 'post',
            paramName: 'file',
            maxFiles: 1,
            maxFileSize: 3,
            acceptedFiles: "image/*",
            addRemoveLinks: true,
            dictDefaultMessage: '拖拽或者点击上传图片',
            dictCancelUpload: '取消',
            dictRemoveFile: '取消',
            init: function () {
                this.on("success", function (file) {
                    if (file.status = 'success') {
                        var path = JSON.parse(file.xhr.responseText).data.path;
                        $('input[name=poster]').val(path);
                        $('input[name=shopPicture]').val(path);
                        $('input[name=wx_head_img]').val(path);
                        $('#dropzone').prev('img').attr('src',path);
                    } else {
                        swal('上传失败','','error');
                    }
                })
            }
        });

</script>
@stack('admin.scripts')
@endpush