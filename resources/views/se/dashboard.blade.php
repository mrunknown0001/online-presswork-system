@extends('layouts.app')

@section('title') Section Editor Dashboard @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Dashboard</h3>

		@include('includes.all')

		<div class="row">
			<div class="col-md-4">
				 <div class="card">
			      <div class="card-body">
			        <h3 class="card-title text-center">{{ $articles_approved }}</h3>
			        <p class="card-text text-center">Approved Articles</p>
			        <a href="{{ route('se.approved.articles') }}" class="btn btn-primary btn-block">View Articles</a>
			      </div>
				</div>
			</div>
			<div class="col-md-4">
		      <div class="card-body">
		        <h3 class="card-title text-center">{{ $articles_denied }}</h3>
		        <p class="card-text text-center">Denied Articles</p>
		        <a href="{{ route('se.view.denied.article') }}" class="btn btn-primary btn-block">View Articles</a>
		      </div>
			</div>
			<div class="col-md-4">
		      <div class="card-body">
		        <h3 class="card-title text-center">{{ $articles_proofreaded }}</h3>
		        <p class="card-text text-center">Proofreaded Articles</p>
		        <a href="{{ route('se.article.proofreaded') }}" class="btn btn-primary btn-block">View Articles</a>
		      </div>
			</div>
	</div>
</div>
@endsection