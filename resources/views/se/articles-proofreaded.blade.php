@extends('layouts.app')

@section('title') Articles @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Proofreaded Articles</h3>

		<p>
			<a href="{{ route('se.articles') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back to Articles</a>
		</p>
		
		@include('includes.all')


	</div>
</div>
@endsection