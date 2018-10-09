<div class="sidebar content-box" style="display: block;">
    <ul class="nav">
        <!-- Main menu -->
        <li class="{{ route('correspondent.dashboard') == url()->current() ? 'current' : '' }}"><a href="{{ route('correspondent.dashboard') }}"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>

        <li class="{{ route('correspondent.articles') == url()->current() ? 'current' : '' }}">
        	<a href="{{ route('correspondent.articles') }}">
        		<i class="glyphicon glyphicon-list-alt"></i> Articles
        	</a>
        </li>

        <li><a href="{{ route('logout') }}"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
    </ul>
</div>