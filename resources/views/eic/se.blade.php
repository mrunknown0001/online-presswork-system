@extends('layouts.app')

@section('title') Section Editor Management @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Section Editor Management</h3>
		<p>
			<a href="{{ route('eic.add.section.editor') }}" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i> Add Section Editor</a>
		</p>

		@include('includes.all')

		@if(count($se) > 0)
			<table class="table table-hover table-bordered table-striped">
				<thead>
					<tr>
						<th class="text-center">Name</th>
						<th class="text-center">Username</th>
						<th class="text-center">Section Assignment</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($se as $s)
						<tr>
							<td class="text-center">
								{{ ucwords($s->lastname . ', ' . $s->firstname) }}
							</td>
							<td class="text-center">
								{{ strtolower($s->username) }}
							</td>
							<td class="text-center">
								{{ ucwords($s->section_assignment->section->name) }}
							</td>
							<td class="text-center">
								<a href="{{ route('eic.update.section.editor', ['id' => $s->id]) }}" class="btn btn-info btn-xs">Update</a>
								<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#removeSectionEditor-{{ $s->id }}">Remove</button>
							</td>
						</tr>
						@include('eic.includes.modal-section-editor-update')
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center">No Section Editor</p>
		@endif

	</div>
	
</div>
@endsection