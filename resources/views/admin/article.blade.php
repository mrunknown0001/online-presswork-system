@extends('layouts.app')

@section('title') ARticle Management @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Article Management</h3>

		@if(count($articles) > 0)
			<div class="col-md-12">
				
			</div>
		@else
			<p class="text-center">No Articles!</p>
		@endif		
	</div>

</div>
@endsection