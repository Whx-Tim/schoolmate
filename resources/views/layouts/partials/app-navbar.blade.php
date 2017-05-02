<!-- Navbar -->
<nav class="navbar navbar-fixed-top Nav">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">导航开关</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ url('logo.png') }}" alt="Logo">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li{{ request()->is('/') ? ' class=on' : '' }}><a href="{{ url('/') }}">主页</a></li>
                <li{{ request()->is('about*') ? ' class=on ' : '' }}><a href="{{ url('about') }}">关于汉雅</a></li>
                <li{{ request()->is('culture*') ? ' class=on' : '' }}><a href="{{ url('culture') }}">香道文化</a></li>
                <li{{ request()->is('course*') ? ' class=on ' : '' }}><a href="{{ url('course') }}">课程通知</a></li>
                <li{{ request()->is('teacher*') ? ' class=on ' : '' }}><a href="{{ url('teacher') }}">师资力量</a></li>
                <li{{ request()->is('train*') ? ' class=on ' : '' }}><a href="{{ url('train') }}">培训动态</a></li>
                <li{{ request()->is('') ? ' class=on ' : '' }}><a href="{{ $weibo }}" target="_blank">汉雅微博</a></li>
                <li{{ request()->is('job*') ? ' class=on ' : '' }}><a href="{{ url('job') }}">招贤纳士</a></li>
            </ul>
            @if(Auth::check())
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="{{ url('manage') }}">后台管理</a>
                    </li>
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out fa-btn"></i>退出</a></li>
                </ul>
            @endif
        </div>
    </div>
</nav>