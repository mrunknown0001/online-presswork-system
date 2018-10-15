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
        @include('includes.all')

          @if(count($value) > 0)
            @foreach($value as $v)
              <h3 class="text-center">{{ ucwords($v->title) }}</h3>
              <div class="text-center">
                <img src="{{ asset('/uploads/banners/' . $v->banner) }}" width="90%" class="img-responsvie img-thumbnail">
              </div>
              <hr>
              <div class="justify">
                {{ $v->rules }}
              </div>
              <hr>
              <div class="text-center">
                <a href="{{ route('submit.entry', ['id' => $v->id]) }}" class="btn btn-primary">Submit Entry</a>
              </div>
              <hr>
            @endforeach
          @else
            <h3 class="text-center">No Activity</h3>
            <div class="text-center">
              <img src="{{ asset('/uploads/logo/logo.jpg') }}" width="90%" class="img-responsvie img-thumbnail">
            </div>
          @endif
          
      </div>
    </div>
</div>
@endsection
