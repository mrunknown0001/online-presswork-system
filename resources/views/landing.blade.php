<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="shortcut icon" href="img/fav.png">

  <meta name="author" content="Colorlib">

  <meta name="description" content="">

  <meta name="keywords" content="">

  <meta charset="UTF-8">

  <title>Online Presswork System</title>

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,500,600" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/linearicons.css') }}">

    <link rel="stylesheet" href="{{ asset('fontawesome/css/font-awesome.min.css') }}">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  </head>
  <body>
    <div class="main-wrapper-first">
      <div class="hero-area relative">
        <header>
          <div class="container">
            <div class="header-wrap">
              <div class="header-top d-flex justify-content-between align-items-center">
                <div class="logo">
                  <a href="index.html"><img src="img/logo_1.png" height="30px" alt=""></a>
                </div>
                <div class="main-menubar d-flex align-items-center">
                  <nav class="hide">
                    <a href="#home">Home</a>
                    <a href="#contact">Contact</a>
                    <a href="#about">About</a>
                  </nav>
                  <div class="menu-bar"><span class="lnr lnr-menu"></span></div>
                </div>
              </div>
            </div>
          </div>
        </header>
        <div class="banner-area">
          <div class="overlay hero-overlay-bg"></div>
          <div class="container">
            <div class="row height align-items-center justify-content-center">
              <div class="col-lg-7">
                <div class="banner-content text-center">

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="main-wrapper">

      <section class="about-top-area">
        <div class="container-fluid">
          <div class="row h-100 justify-content-start align-items-center">
            <div class="col-lg-6 about-left">
              <div class="overlay overlay-bg"></div>
              <!-- <img class="img-fluid" src="img/about.jpg" alt=""> -->
            </div>
            <div class="col-lg-6 about-right pt-30 pb-30">
              <div class="single-desc">
                <!-- <span class="icon lnr lnr-rocket"></span> -->
                <!-- <h2>Becoming A Dvd Repair Expert Online</h2> -->
                <p>
                  <!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. -->
                </p>
              </div>
              <div class="single-desc">
                <!-- <span class="icon lnr lnr-sun"></span> -->
                <!-- <h2>Becoming A Dvd Repair Expert Online</h2> -->
                <p>
                  <!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. -->
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>


      <section class="about-bottom-area">
        <div class="container-fluid">
          <div class="row h-100 justify-content-start align-items-center">
            <div class="col-lg-12 about-left pt-30 pb-30">
              <!-- <div class="single-desc">
                <span class="icon lnr lnr-rocket"></span>
                <h2>Powerful Performance</h2>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                </p>
                <button class="primary-btn hover d-inline-flex align-items-center"><span class="mr-10">Learn More</span><span class="lnr lnr-arrow-right"></span></button>
              </div> -->
            </div>
          </div>
        </div>
      </section>

      <section class="process-area pt-90 pb-90">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
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
                    <a href="{{ route('submit.entry', ['id' => $v->id]) }}" class="btn btn-warning black-button">Submit Entry</a>
                  </div>
                  <hr>
                @endforeach
              @else

              @endif
            </div>
          </div>
        </div>
      </section>

      <section class="newsletter-area pt-60 pb-60">
        <div class="container" id="contact">
          <div class="row justify-content-center align-items-center">
            <div class="text-center">
              <h1 class="text-white">Contact Us</h1>
              
              <p><i class="fa fa-phone-square"></i> Call: 0949 609 6261</p>

              <p><i class="fa fa-envelope-o"></i> Email: <a href="mailto:tsu.thework@gmail.com"  class="text-white"> tsu.thework@gmail.com</a></p>

              <p><i class="fa fa-facebook-square"></i> <a href="https://fb.com/TheWork" class="text-white">The Work</a></p>

              <p><i class="fa fa-twitter-square"></i> <a href="https://twitter.com/theworktsu" class="text-white">The Work TSU</a></p>

              <p><i class="fa fa-instagram"></i> <a href="https://instagram.com/thework.pub" class="text-white">The Work Publication</a></p>
            </div>
          </div>
        </div>
      </section>

      <footer class="section-gap footer-area">
        <div class="container">
          <div class="row pt-60 pb-60">


            <div class="col-lg-12 col-sm-12" id="about">
              <div class="single-footer-widget">
                <h6 class="text-uppercase mb-20">About</h6>
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
          </div>
        </div>
        <div class="footer-bottom d-flex justify-content-between align-items-center flex-wrap">
          <p class="footer-text m-0">Copyright © 2017 All rights reserved</p>
        </div>
      </footer>
    </div>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('css/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
  </body>
</html>
