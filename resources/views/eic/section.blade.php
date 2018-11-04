@extends('layouts.app')

@section('title') Section Management @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Section Management</h3>
		@include('includes.all')
		<p>
			<a href="{{ route('eic.add.section') }}" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i> Add Section</a>
		</p>
		@if(count($sections) > 0)
			<table class="table table-hover table-bordered table-striped">
				<thead>
					<tr>
						<th class="text-center">Section Name</th>
						<th class="">Description</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($sections as $s)
						<tr>
							<td class="text-center">{{ ucwords($s->name) }}</td>
							<td>{{ ucwords($s->description) }}</td>
							<td class="text-center">
								<a href="{{ route('eic.update.section', ['id' => $s->id]) }}" class="btn btn-info btn-xs">Update</a>
								<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#removeSection-{{ $s->id }}">Remove</button>
							</td>
						</tr>
						@include('eic.includes.modal-section-remove')
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center">No Section Found!</p>
		@endif		
	</div>

</div>
@endsection