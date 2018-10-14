@extends('layouts.app')

@section('title') Activities @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Activities</h3>
		<p>
			<a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Activity</a>
			<a href="#" class="btn btn-info btn-sm"><i class="fa fa-history"></i> Activity History</a>

		</p>

		@include('includes.all')
	</div>
</div>
@endsection