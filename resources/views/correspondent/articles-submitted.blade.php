@extends('layouts.app')

@section('title') Articles @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Submitted Articles</h3>
		<p>
			<a href="{{ route('correspondent.new.article') }}" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-asterisk"></i> New Article</a>
			<a href="{{ route('correspondent.submitted.articles') }}" class="btn btn-success btn-sm">Submitted Articles</a>
		</p>

		@include('includes.all')

		

	</div>
</div>
@endsection