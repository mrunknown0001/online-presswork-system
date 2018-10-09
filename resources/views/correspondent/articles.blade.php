@extends('layouts.app')

@section('title') Articles @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Articles</h3>
		<p>
			<a href="{{ route('correspondent.new.article') }}" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-asterisk"></i> New Article</a>
			
		</p>

		@include('includes.all')
		<hr>
		@if(count($articles) > 0)
				@foreach($articles as $a)
					<h4><a href="#">{{ ucwords($a->title) }}</a></h4>
				@endforeach

			<div class="text-center">
				{{ $articles->links() }}
			</div>
		@else
			<p class="text-center">You have not yet submitted any article.</p>
		@endif

	</div>
</div>
@endsection