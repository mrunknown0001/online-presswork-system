@extends('layouts.app')

@section('title') Denied Layout @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Denied Layout</h3>
		<p>
			<a href="{{ route('le.layouts.management') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back to Layouts Management</a>
		</p>



	</div>
</div>
@endsection