@extends('layouts.app')

@section('title') Correspondent Dashboard @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Dashboard</h3>
		
		@include('includes.all')

		<div class="row">
			
		  <div class="col-md-3">
		    <div class="card">
		      <div class="card-body">
		        <h3 class="card-title text-center">{{ count(Auth::user()->articles) }}</h3>
		        <p class="card-text text-center">Number of Articles Submitted</p>
		        <a href="{{ route('correspondent.articles') }}" class="btn btn-primary btn-block">Articles</a>
		      </div>
		    </div>
		  </div>
			
		  <div class="col-md-3">
		    <div class="card">
		      <div class="card-body">
		        <h3 class="card-title text-center">{{ count($approved_articles) }}</h3>
		        <p class="card-text text-center">Number of Approved Articles</p>
		        <a href="{{ route('correspondent.articles') }}" class="btn btn-primary btn-block">Articles</a>
		      </div>
		    </div>
		  </div>

		</div>

	</div>
</div>
@endsection