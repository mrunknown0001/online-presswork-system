@extends('layouts.guest')

@section('title') Welcome @endsection

@section('content')
<div class="header">
     <div class="container">
        <div class="row">
           <div class="col-md-10">
              <div class="logo">
                 <h1><a>Online Presswork System for The Work at Tarlac State Universit</a></h1>
              </div>
           </div>
           <div class="col-md-2">
            <div class="navbar navbar-inverse" role="banner">
                <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                  <ul class="nav navbar-nav">
                    <li>
                      <a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</b></a>
                    </li>
                  </ul>
                </nav>
            </div>
           </div>
        </div>
     </div>
</div>

<div class="page-content container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="wrapper">

            </div>
        </div>
    </div>
</div>
@endsection
