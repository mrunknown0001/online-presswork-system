
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>403 Error</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <h3 href="javascript:void(0)" class="text-center"><b>404</b> Erorr</a></h3>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg"></p>
	<p class="text-center">Unauthorize Access!</p>
	<p class="text-center"><a href="{{ route('landing') }}">return to home</a></p>
  </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
