@extends('layouts.app')

@section('title') Section Management @endsection

@section('content')
<div class="row">
	<h3>Section Management</h3>
	<p>
		<a href="#" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i> Add Section</a>
	</p>
	@if(count($sections) > 0)
		<div class="col-md-12">
			
		</div>
	@else
		<p class="text-center">No Section Found!</p>
	@endif
</div>
@endsection