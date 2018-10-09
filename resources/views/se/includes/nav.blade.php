<div class="sidebar content-box" style="display: block;">
    <ul class="nav">
        <!-- Main menu -->
        <li class="{{ route('se.dashboard') == url()->current() ? 'current' : '' }}"><a href="{{ route('se.dashboard') }}"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>

        <li class="{{ route('se.articles') == url()->current() ? 'current' : '' }}">
        	<a href="{{ route('se.articles') }}">
        		<i class="glyphicon glyphicon-list-alt"></i> Articles
        	</a>
        </li>

        <li><a href="{{ route('logout') }}"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
    </ul>
</div>