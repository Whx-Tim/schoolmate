@extends('layouts.base')

@section('title')@yield('admin.title') - 后台管理@stop

@section('base.content')
    @if(Auth::check())
        @include('layouts.partials.admin-navbar')
    @endif
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
<script src="{{ url('js/plugins/classie.js') }}"></script>
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

    var channel = pusher.subscribe('admin-channel');
    channel.bind('message-event', function(data) {
        toastr.success(data.message);
    });




    toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
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

        var active = parseInt($('#active').html());
        var apply_active = parseInt($('#apply_active').html());
        var league = parseInt($('#league').html());
        var apply_league = parseInt($('#apply_league').html());
        var course = parseInt($('#course').html());
        var apply_course = parseInt($('#apply_course').html());
        var comment = parseInt($('#comment').html());
        var message = parseInt($('#message').html());
        var good = parseInt($('#good').html());
        var active_info = parseInt($('#active_info').html());
        var course_info = parseInt($('#course_info').html());
        var league_info = parseInt($('#league_info').html());
        var users = parseInt($('#users').html());
        var day_users = parseInt($('#day_users').html());
        var month_users = parseInt($('#month_users').html());
        var view_active = parseInt($('#view_active').html());
        var view_course = parseInt($('#view_course').html());
        var view_league = parseInt($('#view_league').html());
        var view_info = parseInt($('#view_info').html());
        var view_announcement = parseInt($('#view_announcement').html());
        var views = parseInt($('#views').html());
        var count = 0;
        var counter = setInterval(function () {
            if (count <= active)$('#active').html(count);
            if (count <= apply_active)$('#apply_active').html(count);
            if (count <= league)$('#league').html(count);
            if (count <= apply_league)$('#apply_league').html(count);
            if (count <= course)$('#course').html(count);
            if (count <= apply_course)$('#apply_course').html(count);
            if (count <= comment)$('#comment').html(count);
            if (count <= message)$('#message').html(count);
            if (count <= good)$('#good').html(count);
            if (count <= active_info)$('#active_info').html(count);
            if (count <= course_info)$('#course_info').html(count);
            if (count <= league_info)$('#league_info').html(count);
            if (count <= users)$('#users').html(count);
            if (count <= day_users)$('#day_users').html(count);
            if (count <= month_users)$('#month_users').html(count);
            if (count <= view_active)$('#view_active').html(count);
            if (count <= view_course)$('#view_course').html(count);
            if (count <= view_league)$('#view_league').html(count);
            if (count <= view_announcement)$('#view_announcement').html(count);
            if (count <= view_info)$('#view_info').html(count);
            if (count <= views)$('#views').html(count);

            if (count <= active || count <= apply_active || count <= league|| count <= apply_league|| count <= course|| count <= apply_course|| count <= comment|| count <= message|| count <= good || count <= active_info || count <= course_info || count <= league_info || count <= users || count <= day_users || count <= month_users
                || count <= view_active
            || count <= view_course
            || count <= view_league
            || count <= view_announcement
            || count <= view_info
            || count <= views) {
                ++count;
            } else {
                clearInterval(counter);
            }
        },15);

</script>
@stack('admin.scripts')
@endpush