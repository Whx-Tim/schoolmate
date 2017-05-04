<aside class="Sidebar">
    <ul class="sidebar-links">
        <li><a href="{{ url('admin') }}" class="{{ request()->is('admin') ? 'selected' : '' }}"><i class="fa fa-dashboard icon-btn"></i>&nbsp;控制台</a></li>
        <li><a href="{{ url('admin/user') }}" class="{{ request()->is('admin/user*') ? 'selected' : '' }}"><i class="fa fa-home icon-btn"></i>&nbsp;用户管理</a></li>
        <li><a href="{{ url('admin/active') }}" class="{{ request()->is('admin/active*') ? 'selected' : '' }}"><i class="fa fa-envira icon-btn"></i>&nbsp;活动管理</a></li>
        <li><a href="{{ url('admin/course') }}" class="{{ request()->is('admin/course*') ? 'selected' : '' }}"><i class="fa fa-wpforms icon-btn"></i>&nbsp;课程管理</a></li>
        <li><a href="{{ url('admin/league') }}" class="{{ request()->is('admin/league*') ? 'selected' : '' }}"><i class="fa fa-users icon-btn"></i>&nbsp;社团管理</a></li>
        <li><a href="{{ url('admin/announcement') }}" class="{{ request()->is('admin/announcement*') ? 'selected' : '' }}"><i class="fa fa-bar-chart icon-btn"></i>&nbsp;公告管理</a></li>
        <li><a href="{{ url('admin/good') }}" class="{{ request()->is('admin/good*') ? 'selected' : '' }}"><i class="fa fa-bar-chart icon-btn"></i>&nbsp;商品管理</a></li>
        <li><a href="{{ url('admin/statistics') }}" class="{{ request()->is('admin/statistics*') ? 'selected' : '' }}"><i class="fa fa-hand-o-right icon-btn"></i>&nbsp;数据统计</a></li>
        <li><a href="{{ url('admin/setting') }}" class="{{ request()->is('admin/setting*') ? 'selected' : '' }}"><i class="fa fa-archive icon-btn"></i>&nbsp;系统设置</a></li>
    </ul>
</aside>