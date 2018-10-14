@extends('layouts.app')

@section('title') Re-Submit Layout @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Re-Submit Layout</h3>
		<p>
			<a href="{{ route('le.layouts.management') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back to Layouts Management</a>
		</p>

		<div class="content-box-header">
			<div class="panel-title">Re-Submit Layout Form</div>
		
			<div class="panel-options">
				{{--<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>--}}
			</div>
		</div>
		<div class="content-box-large box-with-header">
			@include('includes.all')

			<div class="row">
				<div class="col-md-6">
					<p>File: <strong>{{ $layout->filename }}</strong></p>
					<form action="{{ route('le.resubmit.layout.post') }}" method="POST" enctype="multipart/form-data">
						{{ csrf_field() }}
						<input type="hidden" name="id" value="{{ $layout->id }}">
						<div class="form-group">
							<label>Upload Layout New</label>
							<input type="file" name="layout" id="layout" class="form-control" accept="image/jpeg" required>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Re-Submit</button>
							<a href="{{ route('le.denied.layout') }}" class="btn btn-danger">Cancel</a>
						</div>
					</form>					
				</div>
			</div>

		</div>

	</div>
</div>
@endsection