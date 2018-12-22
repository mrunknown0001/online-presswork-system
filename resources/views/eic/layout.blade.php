@extends('layouts.app')

@section('title') Layout Management @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Layout Management</h3>

		<p>
			<a href="{{ route('eic.view.approved.layouts') }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Approved Layouts</a>
			<a href="{{ route('eic.denied.layouts') }}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> Denied Layouts</a>
		</p>

		@include('includes.all')

		@if(count($layouts) > 0)
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th class="text-center">Filename</th>
						<th class="text-center">Version</th>
						<th class="text-center">Date Submitted</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($layouts as $l)
						<tr>
							<td class="text-center">{{ $l->filename }}</td>
							<td class="text-center">{{  number_format((float)$l->version->version, 1, '.', '') }}</td>
							<td class="text-center">
								{{ date('l, F j, Y g:i:s a', strtotime($l->created_at)) }}
							</td>
							<td class="text-center">
								<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#layout-{{ $l->id }}"><i class="fa fa-eye"></i> View</button>
							</td>
						</tr>
						@include('eic.includes.modal-layout-view')
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