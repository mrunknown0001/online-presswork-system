@extends('layouts.app')

@section('title') Publications @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Publications</h3>
		<p>
			
		</p>

		@include('includes.all')

		@if(count($publications) > 0)
			@foreach($publications as $p)
				<p><a href="{{ route('eic.open.publication', ['id' => encrypt($p->id)]) }}" class="btn btn-primary btn-block" >{{ $p->name }}</a></p>
			@endforeach
		@else
			<p class="text-center">No Publications</p>
		@endif
	
	</div>

</div>
@endsection