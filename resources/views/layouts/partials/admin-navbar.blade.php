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
                <li{{ request()->is('admin') ? ' class=on' : '' }}><a href="{{ url('admin') }}">控制台</a></li>
                <li{{ request()->is('admin/user*') ? ' class=on ' : '' }}><a href="{{ url('admin/user') }}">用户管理</a></li>
                <li{{ request()->is('admin/active*') ? ' class=on' : '' }}><a href="{{ url('admin/active') }}">活动管理</a></li>
                <li{{ request()->is('admin/course*') ? ' class=on ' : '' }}><a href="{{ url('admin/course') }}">课程管理</a></li>
                <li{{ request()->is('admin/league*') ? ' class=on ' : '' }}><a href="{{ url('admin/league') }}">社团管理</a></li>
                <li{{ request()->is('admin/announcement*') ? ' class=on ' : '' }}><a href="{{ url('admin/announcement') }}">公告管理</a></li>
                <li{{ request()->is('admin/info*') ? ' class=on ' : '' }}><a href="{{ url('admin/info') }}">信息管理</a></li>
                <li{{ request()->is('admin/good*') ? ' class=on ' : '' }}><a href="{{ url('admin/good') }}">商品管理</a></li>
                <li{{ request()->is('admin/statistics*') ? ' class=on ' : '' }}><a href="{{ url('admin/statistics') }}">数据统计</a></li>
                <li{{ request()->is('admin/data*') ? ' class=on ' : '' }}><a href="{{ url('admin/data') }}">数据工厂</a></li>
                {{--@if(Auth::check())--}}
                    {{--<li><a href="{{ url('admim/logout') }}"><i class="fa fa-sign-out"></i>注销</a></li>--}}
                {{--@endif--}}
            </ul>
        </div>
    </div>
</nav>