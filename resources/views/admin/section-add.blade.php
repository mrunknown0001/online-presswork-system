@extends('layouts.app')

@section('title') Add Section @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Add Section</h3>
		<div class="content-box-header">
			<div class="panel-title">Add New Section Form</div>
		
			<div class="panel-options">
				{{--<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>--}}
			</div>
		</div>
		<div class="content-box-large box-with-header">
			@include('includes.all')
			<form action="{{ route('admin.add.section.post') }}" method="POST" autocomplete="off">
				{{ csrf_field() }}
				<div class="form-group">
					<label>Section Name</label>
					<input type="text" name="name" id="name" class="form-control" placeholder="Section Name" required>
				</div>
				<div class="form-group">
					<label>Section Description</label>
					<textarea name="description" id="description" class="form-control" placeholder="Section Description"></textarea>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary"><i class=""></i> Save</button>
					<a href="{{ route('admin.section.management') }}" class="btn btn-danger"> Cancel</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection