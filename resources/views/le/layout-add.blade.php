@extends('layouts.app')

@section('title') Add Layout @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Add Layout</h3>
		<p>
			<a href="{{ route('le.layouts.management') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back to Layouts Management</a>
		</p>

		<div class="content-box-header">
			<div class="panel-title">Add Layout Form</div>
		
			<div class="panel-options">
				{{--<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>--}}
			</div>
		</div>
		<div class="content-box-large box-with-header">
			@include('includes.all')
			<form action="{{ route('le.add.layout.post') }}" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label>Upload Layout</label>
					<input type="file" name="layout" id="layout" class="form-control" accept="image/x-png,image/jpeg">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Submit</button>
					<a href="{{ route('le.layouts.management') }}" class="btn btn-danger">Cancel</a>
				</div>
			</form>
		</div>

	</div>
</div>
@endsection