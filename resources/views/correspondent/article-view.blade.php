@extends('layouts.app')

@section('title') View Article @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<p><a href="{{ route('correspondent.articles') }}" class="btn btn-primary btn-sm">Back to Articles</a></p>
		<h3>{{ ucwords($article->title) }}</h3>
		@include('includes.all')
		<div>
			{{ $article->content }}
		</div>

	</div>
</div>
@endsection