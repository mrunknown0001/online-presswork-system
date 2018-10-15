@extends('layouts.guest')

@section('title') Welcome @endsection

@section('content')
<div class="header">
     <div class="container">
        <div class="row">
           <div class="col-md-10">
              <div class="logo">
                 <h1><a>Online Presswork System for The Work at Tarlac State University</a></h1>
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
      <div class="col-md-12">
              @if(count($value) > 0)
                @foreach($value as $v)
                  <h3 class="text-center">{{ ucwords($v->title) }}</h3>
                  <div class="text-center">
                    <img src="{{ asset('/uploads/banners/' . $v->banner) }}" class="img-responsvie">
                  </div>
                  <hr>
                  <div class="justify">
                    {{ $v->rules }}
                  </div>
                @endforeach
              @else
                <h3 class="text-center">No Activity</h3>
              @endif
      </div>
    </div>
</div>
@endsection
