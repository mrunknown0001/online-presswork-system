@extends('layouts.guest')

@section('title') Welcome @endsection

@section('content')
<div class="header">
     <div class="container">
        <div class="row">
           <div class="col-md-12">
              <div class="logo">
                 <h1 class="text-center"><a>Online Presswork System for The Work at Tarlac State University</a></h1>
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
          <h3 class="text-center"></h3>
          <div class="text-center">
            <img src="{{ asset('/uploads/logo/logo.jpg') }}" width="90%" class="img-responsvie img-thumbnail">
          </div>
        @endif
        <div class="text-center">
          <a href="#">About The Work</a>
          <a href="#">Mission</a>
          <a href="#">Vision</a>
        </div>
      </div>
    </div>
</div>
@endsection
