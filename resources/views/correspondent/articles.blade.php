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

		@if(count($articles) > 0)
			<ul>
				@foreach($articles as $a)
					<li>
						<a href="#">{{ ucwords($a->title) }}</a>
					</li>	
				@endforeach
			</ul>
		@else
			<p class="text-center">You have not yet submitted any article.</p>
		@endif

	</div>
</div>
@endsection