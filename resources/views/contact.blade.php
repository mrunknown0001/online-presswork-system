<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Contact Us - Online Presswork System for The Work at Tarlac State University</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/font-awesome.css') }}">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/full-slider.css') }}" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="javascript:void(0)"><img src="{{ asset('uploads/logo/logo_1.png') }}" height="30px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('landing') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('about.us') }}">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('contact.us') }}">Contact Us</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
    <div class="container">
      <!-- Page Content -->
      <section class="py-5">
        <div class="row">
          <div class="col-md-12" style="min-height: 500px;">
            <br>
            <h1>Contact Us</h1>

            @include('includes.all')
            
            <p><i class="fa fa-phone-square"></i> Call: 0949 609 6261</p>

            <p><i class="fa fa-envelope-o"></i> Email: <a href="mailto:tsu.thework@gmail.com"> tsu.thework@gmail.com</a></p>

            <p><i class="fa fa-facebook-square"></i> <a href="https://fb.com/TheWork">The Work</a></p>

            <p><i class="fa fa-twitter-square"></i> <a href="https://twitter.com/theworktsu">The Work TSU</a></p>

            <p><i class="fa fa-instagram"></i> <a href="https://instagram.com/thework.pub">The Work Publication</a></p>


          </div>
        </div>
      </section>

    </div>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Online Presswork System for The Work at Tarlac State University</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>

  </body>

</html>
