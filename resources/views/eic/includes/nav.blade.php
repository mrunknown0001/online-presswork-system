<div class="sidebar content-box" style="display: block;">
    <ul class="nav">
        <!-- Main menu -->
        <li class="{{ route('eic.dashboard') == url()->current() ? 'current' : '' }}"><a href="{{ route('eic.dashboard') }}"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>

        <li class="submenu">
	         <a href="#">
	            <i class="glyphicon glyphicon-user"></i> Member's Account
	            <span class="caret pull-right"></span>
	         </a>
	         <!-- Sub menu -->
	         <ul>
	            <li><a href="#">Layout Editor</a></li>
	            <li><a href="#">Section Editor</a></li>
	            <li><a href="#">Correspondent</a></li>
	        </ul>
        </li>

        <li><a href="#"><i class="glyphicon glyphicon-list-alt"></i> Mange Articles</a></li>

        <li><a href="#"><i class="glyphicon glyphicon-picture"></i> Manage Layouts</a></li>

        <li><a href="{{ route('logout') }}"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
    </ul>
</div>