@extends('layouts.app')

@section('title') Manage Layouts @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Manage Layouts</h3>
		<p>
			<a href="{{ route('le.add.layout') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Layout</a>
			<a href="{{ route('le.denied.layout') }}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> View Denied Layouts</a>
		</p>
	</div>
</div>
@endsection