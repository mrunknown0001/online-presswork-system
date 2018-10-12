@extends('layouts.app')

@section('title') Layout Editor Management @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Layout Editor Management</h3>
		{{--<p><a href="{{ route('eic.add.layout.editor') }}" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i> Add Layout Editor</a></p>--}}
		
		@include('includes.all')

		@if(count($le) > 0)
			<table class="table table-hover table-bordered table-striped">
				<thead>
					<tr>
						<th class="text-center">Name</th>
						<th class="text-center">Username</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($le as $l)
						<tr>
							<td class="text-center">
								{{ ucwords($l->lastname . ', ' . $l->firstname) }}
							</td>
							<td class="text-center">
								{{ strtolower($l->username) }}
							</td>
							<td class="text-center">
								<a href="{{ route('eic.update.layout.editor', ['id' => $l->id]) }}" class="btn btn-info btn-xs">Update</a>
								{{--<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#removeLayoutEditor-{{ $l->id }}">Remove</button>--}}
							</td>
						</tr>
						@include('eic.includes.modal-layout-editor-remove')
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center">No Layout Editor</p>
		@endif
	</div>
</div>
@endsection