@extends('layouts.app')

@section('title') Manage Layouts @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Manage Layouts</h3>
		<p>
			<a href="{{ route('le.add.layout') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Layout</a>
			<a href="{{ route('le.denied.layout') }}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> View Denied Layouts</a>
		</p>

		@include('includes.all')

		@if(count($layouts) > 0)
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr><th class="text-center">Publication</th>
						<th class="text-center">Section</th>
						<th class="text-center">Filename</th>
						<th class="text-center">Version</th>
						<th class="text-center">Date Submitted</th>
						<th class="text-center">Status</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($layouts as $l)
						<tr>
							<td class="text-center">{{ ucwords($l->publication->name) }}</td>
							<td class="text-center">{{ ucwords($l->section->name) }}</td>
							<td class="text-center">{{ $l->filename }}</td>
							<td class="text-center">{{  number_format((float)$l->version->version, 1, '.', '') }}</td>
							<td class="text-center">
								{{ date('l, F j, Y g:i:s a', strtotime($l->created_at)) }}
							</td>
							<td class="text-center">
								@if($l->eic_approved == 1)
									<span class="label label-success">Approved</span>
								@else
									<span class="label label-default">Pending</span>
								@endif
							</td>
							<td class="text-center">
								<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#layout-{{ $l->id }}"><i class="fa fa-eye"></i> View</button>
							</td>
						</tr>
						@include('le.includes.modal-layout-view')
					@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{{ $layouts->links() }}
			</div>
		@else
			<p class="text-center">No Layouts Submitted!</p>
		@endif
	</div>
</div>
@endsection