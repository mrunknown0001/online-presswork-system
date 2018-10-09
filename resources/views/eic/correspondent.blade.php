@extends('layouts.app')

@section('title') Correspondent Management @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Correspondent Management</h3>
		<p>
			<a href="{{ route('eic.add.correspondent') }}" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i> Add Correspondent</a>
		</p>

		@include('includes.all')

		@if(count($correspondents) > 0)
			<table class="table table-hover table-bordered table-striped">
				<thead>
					<tr>
						<th class="text-center">Name</th>
						<th class="text-center">Username</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($correspondents as $c)
						<tr>
							<td class="text-center">
								{{ ucwords($c->lastname . ', ' . $c->firstname) }}
							</td>
							<td class="text-center">
								{{ $c->username }}
							</td>
							<td class="text-center">
								<a href="{{ route('eic.update.correspondent', ['id' => $c->id]) }}" class="btn btn-info btn-xs">Update</a>
								<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#removeCorrespondent-{{ $c->id }}">Remove</button>
							</td>
						</tr>
						@include('eic.includes.modal-correspondent-remove')
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center">No Correspondents</p>
		@endif
	</div>
	
</div>
@endsection