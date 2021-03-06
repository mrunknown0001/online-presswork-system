@extends('layouts.app')

@section('title') Add Layout Editor @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Add Layout Editor</h3>
		
		<p>
			<a href="{{ route('eic.layout.editor.management') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back to Layout Editor Management</a>
		</p>

		<div class="content-box-header">
			<div class="panel-title">Add Layout Editor Form</div>
		
			<div class="panel-options">
				{{--<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>--}}
			</div>
		</div>
		<div class="content-box-large box-with-header">
			@include('includes.all')
			<form action="{{ route('eic.add.layout.editor.post') }}" method="POST" autocomplete="off">
				{{ csrf_field() }}
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Firstname</label>
							<input type="text" name="firstname" id="firstname" class="form-control" placeholder="Firstname" required>
						</div>
						<div class="col-md-6">
							<label>Lastname</label>
							<input type="text" name="lastname" id="lastname" class="form-control" placeholder="Lastname" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Username</label>
							<input type="text" name="username" id="username" class="form-control" placeholder="Username" required>							
						</div>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Add Layout Editor</button>
					<a href="{{ route('eic.layout.editor.management') }}" class="btn btn-danger">Cancel</a>
				</div>
			</form>
		</div>


	</div>
</div>
@endsection