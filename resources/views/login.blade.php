<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- styles -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-bg">
    <div class="header">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <!-- Logo -->
                  <div class="logo">
                     <a class="navbar-brand" href="javascript:void(0)"><img src="{{ asset('uploads/logo/logo_1.png') }}" height="30px"></a>
                  </div>
               </div>
            </div>
         </div>
    </div>

    <div class="page-content container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-wrapper">
                    <div class="box">
                        <div class="content-wrap">
                            <h6>Login</h6>
                            @include('includes.all')
                            <form action="{{ route('login.post') }}" method="POST" autocomplete="off">
                              {{ csrf_field() }}
                              <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
                              <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                              <div class="action">
                                  <button type="submit" class="btn btn-primary signup">Login</button>
                                  <a href="{{ route('landing') }}" class="btn btn-danger">Cancel</a>
                              </div>                
                            </form>
                        </div>
                    </div>

                    <div class="already">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
  </body>
</html>