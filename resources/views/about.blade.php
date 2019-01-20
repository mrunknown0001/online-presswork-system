<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>About Us - Online Presswork System for The Work at Tarlac State University</title>

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
    
    <div class="container">
      <!-- Page Content -->
      <section class="py-5">
        <div class="row">
          <div class="col-md-12" style="min-height: 500px;">
            <br>
            <h1>About Us</h1>

            @include('includes.all')

            <p>
              &nbsp;&nbsp;&nbsp;&nbsp;The Work is the official student publication of Tarlac State University (TSU) in Tarlac City, Philippines founded in 1948., it is a student-run newspaper and the official student publication of the university. For over 70 years, it provided TSU with responsible campus journalism, determined advocacies, and truthful inquiry. It is a member of the College Editors Guild of the Philippines (CEGP), the oldest existing alliance of student publications in the country committed to uphold students' rights and press freedom. It has become one of the leading student publications in the region with numerous awards from different journalism competitions, bringing honor and integrity to Tarlac State University. The Work is a member of the College Editors Guild of the Philippines (CEGP), an organization that provides legal support and assistance to student publications.
            </p>

            <p>
              &nbsp;&nbsp;&nbsp;&nbsp;The Work circulates its regular issue at least four times in an academic year and its literary folio, Obra, once in a year. It also releases special issues for the university intramurals and student elections and a mid-year issue after the regular semesters. Apart from its published issues, The Work also holds LAAB, a seminar and workshop for student journalists on campus, and Lathala, an annual literary and arts competition where winning works are published in Obra.
            </p>

            <p>The official student publication of Tarlac State University Member. College Editors Guild of the Philippines</p>
            <p>Products: Magazine, Broadsheet, Tabloid, Newsletter, Literary, Folio</p>

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
