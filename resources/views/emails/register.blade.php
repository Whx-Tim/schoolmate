<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- TODO: 动态Title --}}
    <title>邮件激活 | 校园资源互助平台</title>

    <!-- Styles -->
    <link href="//cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">

    <!-- Favicons -->
    {{--<link rel="icon" href="{{ url('logo.png') }}">--}}
    {{--<link rel="shortcut icon" href="{{ url('logo.png') }}">--}}
    {{--<link rel="apple-touch-icon" href="{{ url('logo.png') }}">--}}
    {{--<link rel="apple-touch-icon-precomposed" href="{{ url('logo.png') }}">--}}


</head>
<body id="app" class="">
<section class="container">
    <h4>请点击一下链接进行激活</h4>
    <a href="{{ url('api/user/fire/'.$code) }}">{{ url('api/user/fire/'.$code) }}</a>
</section>


<!-- JavaScripts -->
{{--<script src="{{ url('assets/js/app.js') }}"></script>--}}


</body>
</html>