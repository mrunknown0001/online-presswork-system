@extends('layouts.app')

@section('title') Activity History @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3> Activitiy History</h3>
		<p>
			<a href="{{ route('eic.activities') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back to Activities</a>

		</p>

		@include('includes.all')
	</div>
</div>
@endsection