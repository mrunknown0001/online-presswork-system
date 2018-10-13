@extends('layouts.app')

@section('title') Database @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Database </h3>
		@include('includes.all')
		<div class="col-md-6">
			<button class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#databaseBackup"><i class="fa fa-download"></i> Backup Database</button>
		</div>
		<div class="col-md-6">
			<button class="btn btn-warning btn-lg btn-block" data-toggle="modal" data-target="#databaseRestore"><i class="fa fa-upload"></i> Restore Database</button>
		</div>
	</div>
</div>
@include('admin.includes.modal-database-backup')
@include('admin.includes.modal-database-restore')
@endsection