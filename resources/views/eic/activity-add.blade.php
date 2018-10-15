@extends('layouts.app')

@section('title') Add Activity @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Add Activity</h3>
		<p>
			<a href="{{ route('eic.activities') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back to Activities</a>

		</p>

		<div class="content-box-header">
			<div class="panel-title">Add Activity Form</div>

			<div class="panel-options">
				{{--<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>--}}
			</div>
		</div>
		<div class="content-box-large box-with-header">
			@include('includes.all')

			<form action="{{ route('eic.add.activity.post') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group">
					<label>Activity Title</label>
					<input type="text" name="title" id="title" class="form-control" placeholder="Activity Title" required>
				</div>
				<div class="form-group">
					<label>Rules:</label>
					<textarea name="rules" id="rules" class="form-control" rows="15" placeholder="Enter Activity Rules" required></textarea>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Start Date</label>
							<input type="date" name="start_date" id="start_date" class="form-control" placeholder="mm/dd/yyyy" required>
						</div>
						<div class="col-md-6">
							<label>End Date</label>
							<input type="date" name="end_date" id="end_date" class="form-control" placeholder="mm/dd/yyyy" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Upload Banner:</label>
					<input type="file" name="banner" id="banner" class="form-control" accept="image/jpeg" required>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Add Activity</button>
					<a href="{{ route('eic.activities') }}" class="btn btn-danger">Cancel</a>
				</div>
			</form>

		</div>


	</div>
</div>
@endsection