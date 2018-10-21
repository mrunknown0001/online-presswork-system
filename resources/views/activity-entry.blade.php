@extends('layouts.guest')

@section('title') Submit Activity Entry @endsection

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
      <div class="col-md-6 col-md-offset-3">
        <div class="content-box-header">
          <div class="panel-title"> Submit Activity Entry </div>
        
          <div class="panel-options">
            {{--<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
            <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>--}}
          </div>
        </div>
        <div class="content-box-large box-with-header">
          @include('includes.all')

          <form action="{{ route('submit.entry.post') }}" method="POST" autocomplete="off" enctype="multipart/form-data">

            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $activity->id }}">
            <div class="form-group">
              <label>Name (optional)</label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
            </div>
            <div class="form-group">
              <label>Email Address</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email Address" required>
            </div>
            <div class="form-group">
              <label>Upload Entry (in pdf format)</label>
              <input type="file" name="entry" id="entry" class="form-control" accept="application/pdf">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Submit Entry</button>
              <a href="{{ route('landing') }}" class="btn btn-danger">Cancel</a>
            </div>
          </form>

        </div>
      </div>
    </div>
</div>
@endsection
