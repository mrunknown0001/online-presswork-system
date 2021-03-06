<div class="header">
    <div class="container">
        <div class="row">
           <div class="col-md-5">
              <!-- Logo -->
              <div class="logo">
                 <h1><a>Correspondent, {{ ucwords(Auth::user()->firstname) }}</a></h1>
              </div>
           </div>
           <div class="col-md-5">
           </div>
           <div class="col-md-2">
              <div class="navbar navbar-inverse" role="banner">
                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                    <ul class="nav navbar-nav">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
                        <ul class="dropdown-menu animated fadeInUp">
                          <li><a href="{{ route('correspondent.change.password') }}">Change Password</a></li>
                          <li><a href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                      </li>
                    </ul>
                  </nav>
              </div>
           </div>
        </div>
    </div>
</div>