<div class="sidebar content-box" style="display: block;">
    <ul class="nav">
        <!-- Main menu -->
        <li class="{{ route('eic.dashboard') == url()->current() ? 'current' : '' }}"><a href="{{ route('eic.dashboard') }}"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>

        <li class="submenu {{ route('eic.layout.editor.management') == url()->current() || route('eic.section.editor.management') == url()->current() || route('eic.correspondent.management') == url()->current() ? 'current' : '' }}">
	         <a href="#">
	            <i class="glyphicon glyphicon-user"></i> Member's Account
	            <span class="caret pull-right"></span>
	         </a>
	         <!-- Sub menu -->
	         <ul>
	            <li class="{{ route('eic.layout.editor.management') == url()->current() ? 'current' : '' }}"><a href="{{ route('eic.layout.editor.management') }}">Layout Editor</a></li>
	            <li class="{{ route('eic.section.editor.management') == url()->current() ? 'current' : '' }}"><a href="{{ route('eic.section.editor.management') }}">Section Editor</a></li>
	            <li class="{{ route('eic.correspondent.management') == url()->current() ? 'current' : '' }}"><a href="{{ route('eic.correspondent.management') }}">Correspondent</a></li>
	        </ul>
        </li>

        <li class="{{ route('eic.article.management') == url()->current() ? 'current' : '' }}"><a href="{{ route('eic.article.management') }}"><i class="glyphicon glyphicon-list-alt"></i> Mange Articles</a></li>

        <li class="{{ route('eic.layout.management') == url()->current() ? 'current' : '' }}"><a href="{{ route('eic.layout.management') }}"><i class="glyphicon glyphicon-picture"></i> Manage Layouts</a></li>

        <li><a href="{{ route('logout') }}"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
    </ul>
</div>