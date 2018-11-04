<div class="sidebar content-box" style="display: block;">
    <ul class="nav">
        <!-- Main menu -->
        <li class="{{ route('admin.dashboard') == url()->current() ? 'current' : '' }}"><a href="{{ route('admin.dashboard') }}"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>

        {{--<li class="{{ route('admin.article.management') == url()->current() ? 'current' : '' }}"><a href="{{ route('admin.article.management') }}"><i class="glyphicon glyphicon-list-alt"></i> Mange Articles</a></li>--}}

        <li class="{{ route('admin.publish') == url()->current() ? 'current' : '' }}"><a href="{{ route('admin.publish') }}"><i class="glyphicon glyphicon-book"></i> Publish</a></li>

        <li class="{{ route('admin.activity.log') == url()->current() ? 'current' : '' }}"><a href="{{ route('admin.activity.log') }}"><i class="glyphicon glyphicon-time"></i> Activity Logs</a></li>
		
		<li class="{{ route('admin.backup.database') == url()->current() ? 'current' : '' }}">
			<a href="{{ route('admin.backup.database') }}">
				<i class="fa fa-database"></i> Database
			</a>
		</li>

        <li><a href="{{ route('logout') }}"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
    </ul>
</div>