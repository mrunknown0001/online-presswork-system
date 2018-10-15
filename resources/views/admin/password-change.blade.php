@extends('layouts.app')

@section('title') Change Password @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Change Password</h3>

		<div class="content-box-header">
			<div class="panel-title">Change Password</div>
		
			<div class="panel-options">
				{{--<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>--}}
			</div>
		</div>
		<div class="content-box-large box-with-header">
			@include('includes.all')
			
			<div class="row">
				<div class="col-md-6">
					<form action="{{ route('admin.change.password.post') }}" method="POST">
						{{ csrf_field() }}
						<div class="form-group">
							<label>Current Password</label>
							<input type="password" name="current_password" id="current_password" class="form-control" placeholder="Enter Current Password" required>
						</div>
						<div class="form-group">
							<label>New Password</label>
							<input type="password" name="password" id="password" class="form-control" placeholder="Enter New Password" required>
						</div>
						<div class="form-group">
							<label>Confirm Password</label>
							<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Change Password</button>
							<a href="{{ route('admin.dashboard') }}" class="btn btn-danger">Cancel</a>
						</div>
					</form>
				</div>
			</div>
					
		</div>
	</div>
	
</div>
@endsection