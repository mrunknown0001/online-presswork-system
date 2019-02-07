<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Online Presswork System for The Work at Tarlac State University</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/full-slider.css') }}" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="javascript:void(0)">THE WORK</a>
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
    
    <div class="container-fluid">
      <!-- Page Content -->
      <section class="py-5">
        <div class="row">
          <div class="col-md-12">
            <header>
              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active" style="background-image: url('{{ asset('uploads/logo/logo4.jpg') }}')">
                  </div>

                </div>
              </div>
            </header>
            <p></p>
            @include('includes.all')

            @if(count($value) > 0)
              <br>
              @foreach($value as $v)
                <h3 class="text-center">{{ ucwords($v->title) }}</h3>
                <div class="text-center">
                  <img src="{{ asset('/uploads/banners/' . $v->banner) }}" width="90%" class="img-responsvie img-thumbnail">
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-10 offset-1">
                    {{ $v->rules }}
                  </div>
                </div>
                <div class="text-center">
                  Activity Period: 
                  <strong>{{ date('F j, Y', strtotime($v->start_date)) }} -
                  {{ date('F j, Y', strtotime($v->end_date)) }}</strong>
                </div>
                <hr>
                <div class="text-center">
                  <a href="{{ route('submit.entry', ['id' => $v->id]) }}" class="btn btn-primary">Submit Entry</a>
                </div>
                <hr>
              @endforeach
            @else

            @endif

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
