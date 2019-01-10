@extends('layouts.app')

@section('title') Layout Editor Dashboard @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Dashboard</h3>

		@include('includes.all')

		<div class="row">
		  <div class="col-md-3">
		    <div class="card">
		      <div class="card-body">
		        <h3 class="card-title text-center">{{ count(Auth::user()->layouts) }}</h3>
		        <p class="card-text text-center">Number of Layouts Submitted</p>
		        <a href="{{ route('le.layouts.management') }}" class="btn btn-primary btn-block">Layouts</a>
		      </div>
		    </div>
		  </div>
		  <div class="col-md-3">
		    <div class="card">
		      <div class="card-body">
		        <h3 class="card-title text-center">{{ count($approved_layouts) }}</h3>
		        <p class="card-text text-center">Number of Approved Layouts</p>
		        <a href="{{ route('le.layouts.management') }}" class="btn btn-primary btn-block">Layouts</a>
		      </div>
		    </div>
		  </div>
	</div>
</div>
@endsection