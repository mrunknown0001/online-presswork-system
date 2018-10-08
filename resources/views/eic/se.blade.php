@extends('layouts.app')

@section('title') Section Editor Management @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Section Editor Management</h3>
		<p>
			<a href="{{ route('eic.add.section.editor') }}" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i> Add Section Editor</a>
		</p>
	</div>
	
</div>
@endsection