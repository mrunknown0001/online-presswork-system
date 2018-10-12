@extends('layouts.app')

@section('title') Update Correspondent @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Update Correspondent</h3>
		
		<p>
			<a href="{{ route('eic.correspondent.management') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back to Correspondents Management</a>
		</p>
		
		<div class="content-box-header">
			<div class="panel-title">Update Correspondent Form</div>
		
			<div class="panel-options">
				{{--<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>--}}
			</div>
		</div>
		<div class="content-box-large box-with-header">
			@include('includes.all')
			<form action="{{ route('eic.update.correspondent.post') }}" method="POST" autocomplete="off">
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{ $c->id }}">
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Firstname</label>
							<input type="text" name="firstname" id="firstname" value="{{ $c->firstname }}" class="form-control" placeholder="Firstname" required>
						</div>
						<div class="col-md-6">
							<label>Lastname</label>
							<input type="text" name="lastname" id="lastname" value="{{ $c->lastname }}" class="form-control" placeholder="Lastname" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Username</label>
							<input type="text" name="username" id="username" value="{{ $c->username }}" class="form-control" placeholder="Username" required>							
						</div>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Update Correspondent</button>
					<a href="{{ route('eic.correspondent.management') }}" class="btn btn-danger">Cancel</a>
				</div>
			</form>
		</div>


	</div>
</div>
@endsection