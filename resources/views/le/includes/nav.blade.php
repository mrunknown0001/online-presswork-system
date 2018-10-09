<div class="sidebar content-box" style="display: block;">
    <ul class="nav">
        <!-- Main menu -->
        <li class="{{ route('le.dashboard') == url()->current() ? 'current' : '' }}"><a href="{{ route('le.dashboard') }}"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>

        <li><a href="{{ route('logout') }}"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
    </ul>
</div>