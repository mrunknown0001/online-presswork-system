@extends('layouts.app')

@section('title') Admin Dashboard @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Dashboard</h3>

		@include('includes.all')

		<div class="row">
			<div class="col-md-4">
			 <div class="card">
		      <div class="card-body">
		        <h3 class="card-title text-center">{{ $approved_layouts }}</h3>
		        <p class="card-text text-center">Approved Layouts</p>
		        <a href="{{ route('admin.publish') }}" class="btn btn-primary btn-block">Layouts</a>
		      </div>
		    </div>
			</div>
			<div class="col-md-4">
			  <div class="card">
		      <div class="card-body">
		        <h3 class="card-title text-center">{{ $activity_logs }}</h3>
		        <p class="card-text text-center">Activity Logs</p>
		        <a href="{{ route('admin.activity.log') }}" class="btn btn-primary btn-block">Activity Logs</a>
		      </div>
		    </div>
			</div>
			<div class="col-md-4">
			  <div class="card">
		      <div class="card-body">
		        <h3 class="card-title text-center">Database</h3>
		        <p class="card-text text-center">Backup and Restore</p>
		        <a href="{{ route('admin.backup.database') }}" class="btn btn-primary btn-block">Backup and Restore</a>
		      </div>
		    </div>
			</div>
		</div>
	</div>
	
</div>
@endsection