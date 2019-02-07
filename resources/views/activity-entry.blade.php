@extends('layouts.guest')

@section('title') Submit Activity Entry @endsection

@section('content')
<div class="header">
     <div class="container">
        <div class="row">
           <div class="col-md-12">
              <div class="logo">
                 <h1 class=""><a>THE WORK</a></h1>
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
            <div class="">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>Firstame (optional)</label>
                  <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter Firstname">
                </div>
                <div class="col-md-6 form-group">
                  <label>Lastname (optional)</label>
                  <input type="text" name="lastname" id="firstname" class="form-control" placeholder="Enter Lastname">
                </div>
                <div class="col-md-6 form-group">
                  <label>Student Number</label>
                  <input type="number" name="student_number" id="student_number" class="form-control" placeholder="Enter Student Number" required>
                </div>
              </div>
              
            </div>
            <div class="form-group">
              <label>Email Address</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email Address" required>
            </div>
            <div class="form-group">
              <label>Upload Entry (pdf/jpeg files)</label>
              <input type="file" name="entry" id="entry" class="form-control" accept="application/pdf,image/jpeg,.psd">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-warning black-button">Submit Entry</button>
              <a href="{{ route('landing') }}" class="btn btn-danger">Cancel</a>
            </div>
          </form>

        </div>
      </div>
    </div>
</div>
@endsection
