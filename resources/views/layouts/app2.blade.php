<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('summernote/dist/summernote.css') }}"> 

    <link rel="stylesheet" type="text/css" href="{{ asset('css/canvas-drawing.css') }}">
   
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('/summernote/dist/summernote-lite.css') }}"> --}}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('summernote/dist/summernote.js') }}"></script>
    {{-- <script src="{{ asset('summernote/dist/summernote-lite.js') }}"></script> --}}
    <script src="{{ asset('clipboardjs/clipboard.min.js') }}"></script>
    <script src="{{ asset('js/mootools.js') }}"></script>
  </head>
  <body>

    <div class="page-content">
    	<div class="row">

		  <div class="col-md-12">
		  	@yield('content')
		  </div>

		</div>
    </div>
	{{--@include('includes.footer')--}}

  </body>
</html>